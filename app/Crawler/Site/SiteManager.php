<?php

namespace App\Crawler\Site;

use App\Crawler\CrawlUrl;
use App\Libs\PhpUri;
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
            $info = explode("|", $info);

            $arrayFilter = explode(" ", $info[1]);
            foreach ($arrayFilter as $filter) {
                if (preg_match('/^[0-9 +-]*$/', $filter)) {
                    $dom_crawler = $dom_crawler->eq($filter);
                } else {
                    $dom_crawler = $dom_crawler->filter($filter);
                }
            }

            if ($dom_crawler->count()) {
                switch ($info[0]) {
                    case 'array':
                        $array[$key] = $dom_crawler->each(function (DomCrawler $node, $i) {
                            return $node->text();
                        });
                        break;

                    case 'text':
                        $array[$key] = $dom_crawler->text();
                        break;

                    case 'href':
                        $download_link = $dom_crawler->attr('href');
                        $array[$key] = PhpUri::parse($this->rootUrl())->join($download_link);
                        break;
                }
            }
        }
        return $array;
    }

    public function configUrlCrawl(string $url, CrawlUrl $crawlUrl)
    {
        if ($url == './') {
            return false;
        }

        if (substr($url, 0, 1) == '/') {
            $url = $this->rootUrl() . $url;
        } else if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $array = explode('/', $crawlUrl->url);
            array_pop($array);
            $url = implode('/', $array) . '/' . $url;
        }

        return $url;
    }

    public function __toString(): string
    {
        return $this->table_url['site'];
    }
}
