<?php

namespace App\Crawler\Queue;
use App\Crawler\CrawlUrl;

interface QueueInterface{
    public function reset(string $site, bool $keep_data = false);

    public function push(CrawlUrl $crawlUrl);

    public function exists(string $url): bool;

    public function hasPendingUrls(string|array $sites): bool;

    public function firstPendingUrl(string|array $sites): ?CrawlUrl;
}
