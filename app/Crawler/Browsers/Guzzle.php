<?php

namespace App\Crawler\Browsers;

use GuzzleHttp\Client;

class Guzzle implements BrowserInterface
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

    public function getHtml(string $url)
    {
        $response = $this->client->get($url);
        $html = $response->getBody()->getContents();
        if (mb_stripos($html, "</a>") === false && mb_stripos($html, "<body") === false) {
            $html = mb_convert_encoding($html, "UTF-8", "UTF-16LE");
        } elseif (mb_stripos($html, "charset=Shift_JIS")) {
            $html = mb_convert_encoding($html, "UTF-8", "SJIS");
            $html = str_replace("charset=Shift_JIS", "charset=UTF-8", $html);
        }
        return $html;
    }
}
