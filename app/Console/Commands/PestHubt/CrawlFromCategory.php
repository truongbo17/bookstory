<?php

namespace App\Console\Commands\PestHubt;

use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\DataStatus;
use App\Models\CrawlUrl;
use Illuminate\Console\Command;

class CrawlFromCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pest:crawlcategory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data from category of site pesthubt';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = CrawlUrl::where('url', 'like', 'https://pesthubt.com/danh-muc%')
            ->get();

        foreach ($categories as $category) {
            foreach (range(1, 100) as $number) {
                CrawlUrl::create([
                    'parent' => $category->url,
                    'url' => $category->url . '?page=' . $number,
                    'url_hash' => $this->hashUrl($category->url . '?page=' . $number),
                    'data_status' => DataStatus::INIT,
                    'status' => CrawlStatus::INIT,
                    'visited' => 0,
                ]);
            }
        }

        return self::SUCCESS;
    }

    public function hashUrl(string $url, string $algo = 'sha256'): string
    {
        $url = preg_replace("/^(https?)?:\/\//", "", $url);
        return hash($algo, $url);
    }
}
