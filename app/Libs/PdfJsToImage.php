<?php

namespace App\Libs;

use GuzzleHttp;
use GuzzleHttp\Client;

class PdfJsToImage
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client(config('crawl.browsers.guzzle'));
        }
    }

    public function getContent(string $download_link)
    {
        $data['download_link'] = $download_link;
        $response = $this->client->requestAsync('POST', route('pdfjs'), [
            'headers' => [
                'Accept' => 'application/json',
            ],
            GuzzleHttp\RequestOptions::JSON => $data
        ]);

        $res = $response->getBody();
        dump($res);
    }
}
