<?php

namespace App\Console\Commands\TestCommand;

use App\Crawler\Browsers\BrowserManager;
use App\Crawler\Browsers\BrowserShot;
use App\Crawler\Browsers\Guzzle;
use App\Crawler\Browsers\Puppeteer;
use Illuminate\Console\Command;

class PuppeteerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:pup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Puppeteer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        dd((new Puppeteer())->getHtml('https://bookstory.asia'));

        $time_start = microtime(true);
        $html = BrowserManager::get('browsershot')->getHtml('https://pesthubt.com');
        dump($html);
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start)/60;
        echo 'Total : '.$execution_time.'mins';
        die;
    }
}
