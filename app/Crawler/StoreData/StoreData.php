<?php

namespace App\Crawler\StoreData;

use App\Models\Document;
use App\Services\DocumentManager;
use Illuminate\Support\Str;
use Log;

class StoreData implements StoreDataInterface
{
    private static $instance;

    public static function create()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function saveData(array $data): bool
    {
        $data_documents = $this->getArrayValue($data, config('crawl.should_get_data'));
        if ($data_documents) {
            return $this->store($data);
        }

        return false;
    }

    public function store(array $data)
    {
        $data = $this->formatData($data);

        $title = $data['title'] ?? "title";
        $slug = Str::slug($title);
        $download_link = $data['download_link'] ?? "download link";
        $content = $data['content'] ?? $title;

        $page = $data['page'] ?? null;
        $binding = $data['binding'] ?? "PDF";
        $code = $data['code'] ?? null;

        $keywords = $data['keywords'] ?? [];
        $categories = $data['categories'] ?? [];
        $users = $data['authors'] ?? [];

        //Check duplicate
        if (Document::where("content_hash", "=", md5($content))->count() > 0) {
            Log::error("Duplicated Content");
            return false;
        }

        $document = Document::create([
            "title" => $title,
            "slug" => $slug,
            "download_link" => $download_link,
            "content_file" => "",
            "content_hash" => md5($content),
            "page" => $page,
            "binding" => $binding,
            "code" => $code,
        ]);

        DocumentManager::updateContentFile($document, $content);
        DocumentManager::updateKeywords($document, $keywords);
        DocumentManager::updateCategories($document, $categories);
        DocumentManager::updateUser($document, $users);

        return true;
    }

    /*
    * Format data
     *
     * title : string
     * authors : array
     * abstract : string
     * description : string
     * download_link : string
     * keywords : array
    */
    public function formatData(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->cleanArray($value);
            }
            if ($key == 'content') {
                $data['content'] = preg_replace('/^Introduction/', '', $data['content']);
            }
        }
        return $data;
    }

    public function cleanArray($value): array
    {
        if ((is_string($value) && mb_strlen($value) > 0) || is_object($value)) {
            $value = (array)$value;
        } elseif ($value == "") {
            $value = [];
        }
        $value = array_filter($value);
        $value = preg_replace('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', '', $value);
        $value = array_map('trim', $value);

        return $value;
    }

    public function getArrayValue($array, $keys)
    {
        $output_arr = [];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array)) return false;
            if ($array[$key] === '') return false;
            $output_arr[] = $array[$key];
        }
        return $output_arr;
    }
}
