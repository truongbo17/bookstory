<?php

namespace App\Console\Commands;

use App\Crawler\Crawler;
use App\Crawler\Queue\CrawlQueue;
use Illuminate\Console\Command;

class AutoCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:auto
        {--reset : reset crawl}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reset = $this->option('reset');

        dump((new Crawler(new CrawlQueue(), $reset))->run());

        $this->info('Success Crawl !!!');
        return self::SUCCESS;
    }
}
