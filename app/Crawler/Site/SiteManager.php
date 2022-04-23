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
        $dom = $dom_crawler;
        $infos = json_decode($this->table_url['should_get_info']);

        $array = [];

        foreach ($infos as $key => $info) {
            $info = explode("|", $info);

            $arrayFilter = explode(" ", $info[1]);

            if (!isset($info[2])) {
                foreach ($arrayFilter as $filter) {
                    if (preg_match('/^[0-9 +-]*$/', $filter)) {
                        $dom = $dom->eq($filter);
                    } else {
                        $dom = $dom->filter($filter);
                    }
                }
            } else if ($info[2] == 'A') {
                //filter all (A : all)
                $dom = $dom->filter($info[1]);
            }

            switch ($info[0]) {
                case 'array':
                    $array[$key] = $dom->each(function (DomCrawler $node, $i) {
                        return $node->text();
                    });
                    $dom = $dom_crawler;
                    break;

                case 'text':
                    if ($dom->count()) {
                        $array[$key] = $dom->text();
                    }
                    $dom = $dom_crawler;
                    break;

                case 'href':
                    $download_link = $dom->attr('href');
                    $array[$key] = PhpUri::parse($this->rootUrl())->join($download_link);
                    $dom = $dom_crawler;
                    break;
            }


        }

        return $array;
    }

    public function configUrlCrawl(string $url, CrawlUrl $crawlUrl)
    {
        if ($this->rootUrl() == 'https://www.scirp.org') {
            if (preg_match("/^journalarticles\.aspx\?journalid=/", $url) || preg_match("/^paperinformation\.aspx\?paperid=/", $url) || preg_match("/^papercitationdetails\.aspx/", $url)) {
                $array = explode('/', $crawlUrl->url);
                array_pop($array);
                $url = implode('/', $array) . '/' . $url;
            } else {
                $url = PhpUri::parse(self::rootUrl())->join($url);
            }
        } else {
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
        }

        return $url;
    }

    public function __toString(): string
    {
        return $this->table_url['site'];
    }
}
