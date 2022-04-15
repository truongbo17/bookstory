<?php

namespace App\Crawler;

use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\DataStatus;
use App\Crawler\Site\SiteInterface;
use App\Crawler\Site\SiteManager;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Psr7\Uri;

class CrawlUrl
{
    protected ?int $id = null;

    protected ?int $url_id = null;

    protected int $visited = 0;

    protected int $data_status = DataStatus::INIT;

    protected int $status = CrawlStatus::INIT;

    protected function __construct(protected SiteInterface $site, public UriInterface $url, public ?UriInterface $foundOnUrl = null)
    {
    }

    public static function fromObject(object $object)
    {
        $site = new SiteManager((array)$object);
        $url = new Uri($object->url);
        $foundOnUrl = $object->parent ? new Uri($object->parent) : null;

        $instance = self::create($site, $url, $foundOnUrl, $object->id);

        $instance->status = $object->status;
        $instance->data_status = $object->data_status;
        $instance->url_id = $object->url_id;
        $instance->visited = $object->visited;

        return $instance;
    }

    public static function create(SiteInterface $site, UriInterface $url, ?UriInterface $foundOnUrl = null, $id = null)
    {
        $static = new static($site, $url, $foundOnUrl);

        if ($id !== null) {
            $static->setId($id);
        }

        return $static;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getDataStatus()
    {
        return $this->data_status;
    }

    public function toArray()
    {
        $data = [
            'url' => $this->url,
            'url_id' => $this->site->table_url['id'],
            'url_hash' => self::hashUrl($this->url),
            'parent' => $this->foundOnUrl,
            'status' => $this->status,
            'data_status' => $this->data_status,
            'visited' => $this->visited,
        ];

        if ($this->id) {
            $data['id'] = $this->id;
        }

        return $data;
    }

    public static function hashUrl(string $url, string $algo = 'sha256'): string
    {
        $url = preg_replace("/^(https?)?:\/\//", "", $url);
        return hash($algo, $url);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStatusErrorData()
    {
        $this->data_status = DataStatus::GET_DATA_ERROR;
    }
}
