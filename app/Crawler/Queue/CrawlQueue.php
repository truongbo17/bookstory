<?php

namespace App\Crawler\Queue;

use DB;
use Illuminate\Support\Arr;
use PDO;
use App\Models\CrawlUrl;
use App\Models\Url;
use App\Crawler\Enum\DataStatus;
use App\Crawler\CrawlUrl as Crawl;
use App\Crawler\Enum\CrawlStatus;

class CrawlQueue implements QueueInterface
{
    public function reset(string $site, bool $keep_data = false)
    {
        $url_id = Url::where('site', $site)->first()->id;
        //if keep_data = true => keep data using when
        return CrawlUrl::where('url_id', $url_id)
            ->when($keep_data, function ($query) {
                $query->where('data_status', '<>', DataStatus::HAS_DATA);
            })
            ->delete();
    }

    public function hasPendingUrls(string|array $sites): bool
    {
        $sites = Arr::wrap($sites);
        $urls_id = Url::whereIn('site', $sites)->get('id');

        return CrawlUrl::whereIn('url_id', $urls_id)
            ->where('status', CrawlStatus::INIT)
            ->exists();
    }

    public function firstPendingUrl(string|array $sites): ?Crawl
    {
        $sites = Arr::wrap($sites);
        $urls_id = Url::whereIn('site', $sites)->get('id');

        return DB::transaction(function () use ($urls_id) {
            $first = DB::table('crawl_urls')
                ->whereIn('url_id', $urls_id)
                ->where('status', CrawlStatus::INIT)
                ->orderBy('visited')
                ->lock($this->getLockForPopping())
                ->first();

            if ($first) {
                $crawlUrl =  Crawl::fromObject($first); //convert first to custom object
                $this->changeProcessStatus($crawlUrl, CrawlStatus::VISITING); //change visit status

                return $crawlUrl;
            } else {
                return null;
            }
        });
    }

    /**
     * Get the lock required for popping the next document.
     *
     * @return string|bool
     */
    protected function getLockForPopping()
    {
        $databaseEngine = DB::getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $databaseVersion = DB::getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION);

        if ($databaseEngine == 'mysql' && !strpos($databaseVersion, 'MariaDB') && !strpos($databaseVersion, 'TiDB') && version_compare($databaseVersion, '8.0.1', '>=') ||
            $databaseEngine == 'pgsql' && version_compare($databaseVersion, '9.5', '>=')) {
            return 'FOR UPDATE SKIP LOCKED';
        }

        return true;
    }

    public function changeProcessStatus(Crawl $crawlUrl, $status = null)
    {
        $data = ['status' => $status ?? $crawlUrl->getStatus()];

        if ($data['status'] == CrawlStatus::VISITING) {
            $data['visited'] = DB::raw('visited + 1'); //visited = visited + 1
        }

        if ($data['status'] == CrawlStatus::DONE) {
            $data['data_status'] = $crawlUrl->getDataStatus();
        }

        return CrawlUrl::where('id', $crawlUrl->getId())
            ->update($data);
    }

    public function push(Crawl $crawlUrl)
    {
        if (self::exists($crawlUrl->url)) {
            return false;
        }
        $data = $crawlUrl->toArray();
        $data['created_at'] = \Carbon\Carbon::now();
        $data['updated_at'] = \Carbon\Carbon::now();

        $inserted = CrawlUrl::insertGetId($data);

        if ($inserted) {
            $crawlUrl->setId($inserted);
        }

        return $crawlUrl;
    }

    public function exists(string $url, string $site = null): bool
    {
        $db = DB::table('crawl_urls');
        if ($site !== null) {
            $db = $db->where('site', $site);
        }
        return $db->where('url_hash', Crawl::hashUrl($url))->exists();
    }
}
