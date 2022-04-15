<?php

namespace App\Crawler;

use App\Crawler\Queue\QueueInterface;
use App\Crawler\Browsers\BrowserManager;
use App\Crawler\Site\SiteInterface;
use App\Crawler\Site\SiteManager;
use App\Models\Url;
use App\Crawler\Enum\UrlStatus;
use App\Crawler\CrawlUrl;
use GuzzleHttp\Psr7\Uri;
use Vuh\CliEcho\CliEcho;
use GuzzleHttp\Exception\GuzzleException;
use App\Crawler\Enum\CrawlStatus;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use App\Libs\PhpUri;
use Exception;

class Crawler
{
    public function __construct(protected QueueInterface $queue, public bool $reset = false)
    {
    }

    public function run()
    {
        $sites = Url::where('status', UrlStatus::INIT)->get()->toArray();

        foreach ($sites as $key => $site) {
            $site = new SiteManager($site);
            $this->init($site); //init site

            while ($this->queue->hasPendingUrls($site)) {
                $crawl_url = $this->queue->firstPendingUrl($site);
                if (empty($crawl_url)) continue;

                //GET HTML
                try {
                    CliEcho::infonl("Goto: [$crawl_url->url]");
                    $html = BrowserManager::get($site->table_url['driver_browser'])->getHtml($crawl_url->url);
                } catch (GuzzleException $exception) {
                    CliEcho::errornl($exception->getMessage());
                    if (in_array($exception->getCode(), config('crawl.should_retry_status_codes'))) {
                        $crawl_url->setStatus(CrawlStatus::INIT);
                    } else {
                        $crawl_url->setStatus(CrawlStatus::FAIL);
                    }
                    continue;
                }

                //CRAWL
                try {
                    //Using Sysfony/Crawler
                    $dom_crawler = new DomCrawler($html);

                    $urls = $this->getAllUrl($site, $dom_crawler, $crawl_url); //get all url of dom url current

                    if ($site->shouldGetData($crawl_url->url)) {
                        try {
                            $data = $site->getInfoFromCrawler($dom_crawler, $crawl_url->url); //get data

                            dump($data);
                            /*
                             * save data
                             * */

                        } catch (Exception $e) {
                            $crawl_url->setStatusErrorData(); //error data
                        }
                    }
                    $crawl_url->setStatus(CrawlStatus::DONE); //set status for instance
                    $this->queue->changeProcessStatus($crawl_url, $crawl_url->getStatus()); //set status in database

                    foreach ($urls as $url) {
                        if (!$site->shouldCrawl($url) && !$site->shouldGetData($url)) {
                            continue;
                        }
                        $crawl_url = CrawlUrl::create($site, new Uri($url), $crawl_url->url); //new instance url
                        $this->queue->push($crawl_url); //push all url to database => pending url crawl
                    }
                } catch (Exception $exception) {
                    CliEcho::errornl('Fail : ' . $exception->getMessage());
                    $crawl_url->setStatus(CrawlStatus::FAIL);
                }
            }
        }
    }

    public function init(SiteInterface $site)
    {
        if ($this->reset) $this->queue->reset($site->table_url['site']);

        foreach ($site->startUrls() as $url) {
            $crawl_url = CrawlUrl::create($site, new Uri($url));

            if ($this->queue->push($crawl_url)) {
                CliEcho::successnl("Site : " . $site->table_url['site'] . " Added " . $crawl_url->url);
            }
        }
    }

    public function getAllUrl(SiteInterface $site, DomCrawler $dom_crawler, CrawlUrl $crawlUrl)
    {
        $urls_selector = $dom_crawler->filter('a');
        $urls = [];
        $checkMethod = method_exists($site, 'configUrlCrawl') ?? false; //check method 1 lan

        foreach ($urls_selector as $item) {
            $item = $item->getAttribute('href');

            $item = preg_replace("/(#\w+)$/", '', $item); //delete fragment #tag

            if ($checkMethod) {
                $item = $site->configUrlCrawl($item, $crawlUrl);
            } else {
                $item = PhpUri::parse($site)->join($item); //return full url include domain
            }

            $urls[] = $item;
        }

        return array_unique($urls);
    }

    public function getHtml()
    {

    }
}
