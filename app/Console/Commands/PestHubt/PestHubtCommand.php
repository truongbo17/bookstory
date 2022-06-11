<?php

namespace App\Console\Commands\PestHubt;

use App\Crawler\Browsers\BrowserManager;
use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\DataStatus;
use App\Crawler\Enum\Status;
use App\Crawler\HandlePdf\PdfToImage;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Libs\PhpUri;
use App\Libs\TitleToImage;
use App\Models\CrawlUrl;
use App\Models\Document;
use App\Services\DocumentManager;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Vuh\CliEcho\CliEcho;

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

    protected array $site = ['root_url' => 'https://pesthubt.com', 'start_url' => 'https://pesthubt.com', 'should_crawl_url' => '/^https:\/\/pesthubt\.com/', 'should_get_data' => '/^https:\/\/pesthubt\.com\/\w*\/\w*\/(.*).html/', 'should_get_info' => 'section.content.container-fluid.custom-content script', 'skip_url' => ['/^https:\/\/pesthubt\.com\/danh-sach-yeu-thich.html/', '/^https:\/\/pesthubt\.com\/admin/', '/^https:\/\/pesthubt\.com\/thu-vien-sach/', '/^https:\/\/pesthubt\.com\/login/', '/^https:\/\/pesthubt\.com\/plugins/', '/^https:\/\/pesthubt\.com\/css/', '/^https:\/\/pesthubt\.com\/dist/', '/^https:\/\/pesthubt\.com\/js/', '/^https:\/\/pesthubt\.com\/download\/view/',],];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->init(); //Init crawl

        //Check pending
        $check_pending_url = CrawlUrl::where('url', 'LIKE', 'https://pesthubt.com%')->where('status', CrawlStatus::INIT)->exists();
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

                        $author = $data['user']['fullname'];

                        $category[] = $data['category']['category'];
                        $category[] = 'hubt';
                        $category[] = 'kinh công';
                        $category[] = 'đại học kinh doanh và công nghệ hà nội';
                        $category[] = 'kinh doanh và công nghệ';

                        $content = $data['note'];

                        $data['title'] = $data['title'] . ' - hubt';
                        $data['author'] = $author;
                        $data['category'] = $category;
                        $data['content'] = $content . ' - hubt';
                        if (is_null($content)) {
                            $data['content'] = $data['title'];
                        }

                        $data = Arr::only($data, ['title', 'category', 'content', 'author', 'quiz_content']);

                        $document = Document::create(["title" => $data['title'], "slug" => createSlug($data['title']), "download_link" => "", "content_file" => "", "binding" => "PDF", "count_page" => null, "content_hash" => md5($data['content']), "image" => "", "is_crawl" => 1, "status" => Status::PENDING,]);

                        DocumentManager::updateContentFile($document, $data['content']);
                        DocumentManager::updateKeywords($document, $data['category']);
                        DocumentManager::updateUser($document, array($data['author']));

                        try {
                            $data_pdf = ['title' => $data['title'], 'quizs' => $data['quiz_content'],];
                            $pdf = PDF::loadView('pdf.pest', $data_pdf);

                            $file_name = IdToPath::make($document->id, 'pdf');
                            $file_name = new DiskPathInfo(config('crawl.pdf_disk'), config('crawl.path.document_pdf') . '/' . $file_name);
                            $file_name->put($pdf->output());
                            $document->download_link = $file_name;
                            $document->save();

                            if (getCountPagePdf($file_name->read(),'content') > config('crawl.max_pdf_count_page')) {
                                if (is_null($document->count_page)) $document->count_page = getCountPagePdf($file_name->view());
                                $img = new TitleToImage();
                                $img->createImage($data['title']);
                                $document->image = $img->saveImage($document)->__toString();
                            } else {
                                $pdf_to_image = new PdfToImage();
                                $pdf_to_image = $pdf_to_image->saveImageFromPdf($document);

                                $document->image = $pdf_to_image['image']->__toString();
                                if (is_null($document->count_page)) $document->count_page = $pdf_to_image['count_page'];
                            }

                            if ($document->save()) {
                                CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::HAS_DATA]);
                            } else {
                                CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::GET_DATA_ERROR]);
                            }
                        } catch (Exception $exception) {
                            \Log::error($exception);
                            CrawlUrl::find($crawl_url['id'])->update(['data_status' => DataStatus::GET_DATA_ERROR]);
                        }

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
                        CrawlUrl::create(['url' => $url, 'url_hash' => $this->hashUrl($url), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),]);
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
            $push = CrawlUrl::insertGetId(['url' => $this->site['root_url'], 'url_hash' => $this->hashUrl($this->site['root_url']), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),]);

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
            $first = CrawlUrl::where('url', 'LIKE', 'https://pesthubt.com%')->where('status', CrawlStatus::INIT)->orderBy('visited')->lock($this->getLockForPopping())->first();

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

        if ($databaseEngine == 'mysql' && !strpos($databaseVersion, 'MariaDB') && !strpos($databaseVersion, 'TiDB') && version_compare($databaseVersion, '8.0.1', '>=') || $databaseEngine == 'pgsql' && version_compare($databaseVersion, '9.5', '>=')) {
            return 'FOR UPDATE SKIP LOCKED';
        }

        return true;
    }
}
