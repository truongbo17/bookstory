<?php

namespace App\Console\Commands\TestCommand;

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
        dd((new Puppeteer())->getHtml('https://bookstory.asia'));
    }
}
