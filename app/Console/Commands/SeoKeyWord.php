<?php

namespace App\Console\Commands;

use App\Crawler\Enum\SeoKeywordStatus;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Models\Document;
use App\Models\Keyword;
use ElasticScoutDriverPlus\Support\Query;
use Illuminate\Console\Command;
use App\Models\SeoKeyword as SeoKeyModel;

class SeoKeyWord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:keyword
    {--reset : reset seo keyword}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seo key word match with title and content';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reset = $this->option('reset');

        if ($reset) {
            Keyword::where('status', '<>', SeoKeywordStatus::INIT)->update(['status' => SeoKeywordStatus::INIT]);
        }

        while ($this->hasPendingKeyword()) {
            $keyword = $this->firstKeyword();
            if ($this->checkExistSeoKeyWord($keyword->content)) {
                $keyword->status = SeoKeywordStatus::SEO_KEYWORD_ERROR;
                continue;
            }
            $this->info("Seo keyword : $keyword->content");
            $query = Query::multiMatch()
                ->fields(['title', 'content'])
                ->query($keyword->content);

            $searchResult = Document::searchQuery($query)
                ->highlightRaw([
                    "pre_tags" => ["<b>"],
                    "post_tags" => ["</b>"],
                    'fields' =>
                        [
                            'title' => ['number_of_fragments' => 0],
                            'content' => ['number_of_fragments' => 3],
                        ]
                ])
                ->execute();

            if ($searchResult->total() > 0) {

                $hits = $searchResult->hits();
                $highlights = $searchResult->highlights();

                $seo_keyword = SeoKeyModel::create([
                    'title' => $keyword->content,
                    'slug' => createSlug($keyword->content),
                    'title_hash' => $this->hashTitle($keyword->content),
                    'documents_matched' => $searchResult->total(),
                    'length' => mb_strlen($keyword->content),
                ]);


                $hits_json = [];
                foreach ($highlights as $key => $highlight) {
                    if (!array_key_exists('title', $highlight->raw())) {
                        $hits_json['title'] = $hits[$key]->document()->content()['title'];
                    } else {
                        $hits_json['title'] = implode("...", $highlight->raw()['title']);
                    }

                    if (!array_key_exists('content', $highlight->raw())) {
                        $hits_json['content'] = $hits[$key]->document()->content()['content'];
                    } else {
                        $hits_json['content'] = implode("...", $highlight->raw()['content']);
                    }

                    $hits_json['document_id'] = $hits[$key]->document()->content()['document_id'];
                    $hits_json['slug'] = $hits[$key]->document()->content()['slug'];
                    $hits_json['image'] = $hits[$key]->document()->content()['image'] ?? null;
                }
                $hits_json = json_encode($hits_json);

                $file_name = IdToPath::make($seo_keyword->id, 'json');
                $file_name = new DiskPathInfo(config('crawl.document_disk'), config('crawl.path.seo_keyword_file') . '/' . $file_name);
                $file_name->put($hits_json);
                $seo_keyword->hits = $file_name;

                if ($seo_keyword) {
                    $keyword->status = SeoKeywordStatus::HAS_SEO_KEYWORD;
                    $this->info('Success...');
                } else {
                    $keyword->status = SeoKeywordStatus::SEO_KEYWORD_ERROR;
                    $this->error('Fail...');
                }

                $seo_keyword->save();
            } else {
                $keyword->status = SeoKeywordStatus::SEO_KEYWORD_NO_DATA;
                $this->warn('No result...');
            }
            $keyword->save();
        }


        $this->info('Success seo keyword');
        return self::SUCCESS;
    }

    public function hasPendingKeyword()
    {
        return Keyword::where('status', SeoKeywordStatus::INIT)
            ->exists();
    }

    public function firstKeyword()
    {
        return Keyword::where('status', SeoKeywordStatus::INIT)->first();
    }

    public function hashTitle(string $title, string $algo = 'sha256'): string
    {
        $title = preg_replace("/^(https?)?:\/\//", "", $title);
        return hash($algo, $title);
    }

    public function checkExistSeoKeyWord(string $title)
    {
        return SeoKeyModel::where('title_hash', $this->hashTitle($title))->exists();
    }
}
