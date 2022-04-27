<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    protected Client $client;

    public function handle()
    {

        $this->client = new Client(config('crawl.browsers.guzzle'));

        $url = 'https://pesthubt.com/quiz/update-download';

        $response = $this->client->post($url,
            [
                GuzzleHttp\RequestOptions::JSON =>
                    ['_token' => '6TzmqLD4mt7Riz4kHUnYHs3J0j58IRdFBPXLPSfw']
            ],
            ['Content-Type' => 'application/json']
        );
        $html = $response->getBody()->getContents();

        dd($html);
    }
}
