<?php

namespace App\Console\Commands;

use App\Crawler\Browsers\BrowserManager;
use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\DataStatus;
use App\Crawler\StoreData\StoreData;
use App\Libs\PhpUri;
use App\Models\CrawlUrl;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDO;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Vuh\CliEcho\CliEcho;
use Exception;
use Illuminate\Support\Facades\Log;

class PestHubtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pest:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data from pesthubt.com and convert data to PDF ';

    protected array $site = [
        'root_url' => 'https://pesthubt.com',
        'start_url' => 'https://pesthubt.com',
        'should_crawl_url' => '/^https:\/\/pesthubt\.com/',
        'should_get_data' => '/^https:\/\/pesthubt\.com\/\w*\/\w*\/(.*).html/',
        'should_get_info' => 'section.content.container-fluid.custom-content script',
        'skip_url' => [
            '/^https:\/\/pesthubt\.com\/danh-sach-yeu-thich.html/',
            '/^https:\/\/pesthubt\.com\/admin/',
            '/^https:\/\/pesthubt\.com\/thu-vien-sach/',
            '/^https:\/\/pesthubt\.com\/login/',
            '/^https:\/\/pesthubt\.com\/plugins/',
            '/^https:\/\/pesthubt\.com\/css/',
            '/^https:\/\/pesthubt\.com\/dist/',
            '/^https:\/\/pesthubt\.com\/js/',
            '/^https:\/\/pesthubt\.com\/download\/view/',
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->init(); //Init crawl

        //Check pending
        $check_pending_url = CrawlUrl::where('url', 'LIKE', 'https://pesthubt.com%')
            ->where('status', CrawlStatus::INIT)
            ->exists();
        while ($check_pending_url) {
            $crawl_url = $this->firstPendingUrl();
            if (empty($crawl_url)) continue;
            //GET HTML
            try {
                CliEcho::infonl("Goto: [" . $crawl_url['url'] . "] - Time : " . Carbon::now()->toDateTimeString());
                $html = BrowserManager::get('puppeteer')->getHtml($crawl_url['url']);
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
                if (in_array($exception->getCode(), config('crawl.should_retry_status_codes'))) {
                    CrawlUrl::find($crawl_url['id'])->update(['status' => CrawlStatus::INIT]);
                } else {
                    CrawlUrl::find($crawl_url['id'])->update(['status' => CrawlStatus::FAIL]);
                }
                continue;
            }

            try {
                $dom_crawler = new DomCrawler($html);
                $urls = $this->getAllUrl($dom_crawler); //get all url of dom url current

                //GET DATA
                if (preg_match($this->site['should_get_data'], $crawl_url['url'])) {
                    try {
                        dump('get data....');

                        $linkCrawler = $dom_crawler->filter($this->site['should_get_info'])->text();
                        $string = preg_replace('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/', '', $linkCrawler);
                        $string = preg_replace('/(\s)console\.log[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/', '', $string);

                        $array_data = json_decode($string, true);
                        $data = $array_data['quiz'];

                        $author[] = $data['user']['fullname'];
                        $category[] = $data['category']['category'];
                        $content = $data['note'];

                        $data['author'] = $author;
                        $data['category'] = $category;
                        $data['content'] = $content;
                        if (is_null($content)) {
                            $data['content'] = $data['title'];
                        }

                        $unset_key_object = [
                            'id',
                            'note',
                            'category_id',
                            'user_id',
                            'total_question',
                            'created_at',
                            'viewed',
                            'quiz_slug',
                            'status',
                            'download',
                            'updated_at',
                            'total_time',
                            'total_grade',
                            'liked_count',
                            'is_liked',
                            'is_favorited',
                            'answer_shuffle',
                            'qs_shuffle',
                            'mode',
                            'user',
                            'category',
                            'check_quiz',
                        ];
                        foreach ($unset_key_object as $key) {
                            unset($data[$key]);
                        }

                        $data = [
                            'title' => $data['title'],
                            'quizs' => $data['quiz_content'],
                        ];

//                        dd($data['quizs']);

                        try {
                            $pdf = PDF::loadView('pdf.pest', $data);
                            Storage::put('public/pdf/invoice.pdf', $pdf->output());
                        } catch (Exception $exception) {
                            dd($exception);
                        }

//                        $check_data = StoreData::create();
//                        $check = $check_data->saveData($data);
//
//                        if ($check) {
//                            CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::HAS_DATA]);
//                        } else {
//                            CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::NO_DATA]);
//                        }
                    } catch (Exception $e) {
                        Log::error($e);
                        CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::GET_DATA_ERROR]);
                    }
                }

                CrawlUrl::find($crawl_url['id'])->update(['status' => CrawlStatus::DONE]);
                CrawlUrl::find($crawl_url['id'])->update(['visited' => 1]);

                foreach ($urls as $url) {
                    if (!preg_match($this->site['should_crawl_url'], $url) && !preg_match($this->site['should_get_data'], $url)) {
                        continue;
                    }
                    //push all url to database => pending url crawl
                    if (!$this->exists($url)) {
                        CrawlUrl::create([
                            'url' => $url,
                            'url_hash' => $this->hashUrl($url),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

            } catch (Exception $exception) {
                $this->info('Fail : ' . $exception->getMessage());
                CrawlUrl::find($crawl_url['id'])->update(['status' => CrawlStatus::FAIL]);
            }


        }

        $this->info('Success Crawl');
        return self::SUCCESS;
    }

    public function getAllUrl($dom_crawler)
    {
        $urls_selector = $dom_crawler->filter('a');
        $urls = [];

        foreach ($urls_selector as $item) {
            $item = $item->getAttribute('href');

            $item = preg_replace("/(#\w+)$/", '', $item); //delete fragment #tag

            $item = PhpUri::parse($this->site['root_url'])->join($item); //return full url include domain

            foreach ($this->site['skip_url'] as $skip_url) {
                if (preg_match($skip_url, $item)) continue 2;
            }

            $urls[] = $item;
        }

        return array_unique($urls);
    }

    public function init()
    {
        if (!$this->exists($this->site['root_url'])) {
            $push = CrawlUrl::insertGetId([
                'url' => $this->site['root_url'],
                'url_hash' => $this->hashUrl($this->site['root_url']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($push) {
                $this->info("Site : pesthubt Added " . $this->site['root_url']);
            }
        }
        return false;
    }

    public function exists(string $url): bool
    {
        return CrawlUrl::where('url_hash', $this->hashUrl($url))->exists();
    }

    public function hashUrl(string $url, string $algo = 'sha256'): string
    {
        $url = preg_replace("/^(https?)?:\/\//", "", $url);
        return hash($algo, $url);
    }

    public function firstPendingUrl()
    {
        return DB::transaction(function () {
            $first = CrawlUrl::where('url', 'LIKE', 'https://pesthubt.com%')
                ->where('status', CrawlStatus::INIT)
                ->orderBy('visited')
                ->lock($this->getLockForPopping())
                ->first();

            if ($first) {
                $first->status = CrawlStatus::VISITING;
                $first->save();

                return $first->toArray();
            } else {
                return null;
            }
        });
    }

    protected function getLockForPopping()
    {
        $databaseEngine = DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $databaseVersion = DB::getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION);

        if ($databaseEngine == 'mysql' && !strpos($databaseVersion, 'MariaDB') && !strpos($databaseVersion, 'TiDB') && version_compare($databaseVersion, '8.0.1', '>=') ||
            $databaseEngine == 'pgsql' && version_compare($databaseVersion, '9.5', '>=')) {
            return 'FOR UPDATE SKIP LOCKED';
        }

        return true;
    }
}
