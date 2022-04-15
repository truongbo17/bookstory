<?php

namespace App\Crawler\Site;

use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class SiteManager implements SiteInterface
{
    public function __construct(public array $table_url)
    {
    }

    public function rootUrl(): string
    {
        return $this->table_url['site'];
    }

    public function startUrls(): array
    {
        return explode(",", $this->table_url['url_start']);
    }

    public function shouldCrawl(string $url)
    {
        return preg_match($this->table_url['should_crawl'], $url);
    }

    public function shouldGetData(string $url)
    {
        return preg_match($this->table_url['should_get_data'], $url);
    }

    public function getInfoFromCrawler(DomCrawler $dom_crawler, string $url = '')
    {
        $infos = json_decode($this->table_url['should_get_info']);
        $array = [];
        foreach ($infos as $key => $info) {
            $arrayFilter = explode(" ", $info);
            foreach ($arrayFilter as $filter) {
                if (preg_match('/^[0-9 +-]*$/', $filter)) {
                    $dom_crawler = $dom_crawler->eq($filter);
                } else {
                    $dom_crawler = $dom_crawler->filter($filter);
                }
            }
            if ($dom_crawler->count()) {
                $array[$key] = $dom_crawler->text();
            }
        }
        return $array;
    }

    public function __toString(): string
    {
        return $this->table_url['site'];
    }
}
