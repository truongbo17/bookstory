<?php

namespace App\Crawler\StoreData;

use App\Crawler\Enum\Status;
use App\Jobs\DownloadFilePdf;
use App\Models\Document;
use App\Services\DocumentManager;
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
        //Check slug
        $slug = createSlug($title);

        $download_link = $data['download_link'] ?? "";
        $content = $data['content'] ?? $title;

        $count_page = $data['count_page'] ?? null;
        $binding = $data['binding'] ?? "PDF";
        $code = $data['code'] ?? null;
        $image = $data['image'] ?? "";

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
            "download_link" => "",
            "content_file" => "",
            "content_hash" => md5($content),
            "count_page" => $count_page,
            "binding" => $binding,
            "code" => $code,
            "image" => $image,
            'is_crawl' => 1,
            'status' => Status::PENDING,
        ]);

        DocumentManager::updateContentFile($document, $content);
        DocumentManager::updateKeywords($document, $keywords);
        DocumentManager::updateUser($document, $users);

        DownloadFilePdf::dispatch($document, $download_link);

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
                $data['content'] = str_replace('Introduction', '', $data['content']);
            }
        }
        return $data;
    }

    public function cleanArray($value): array
    {
        //Array
        if ((is_string($value) && mb_strlen($value) > 0) || is_object($value)) {
            $value = (array)$value;
        } elseif ($value == "") {
            $value = [];
        }

        //Replace ký tự thừa
        $parent_replace_array = [
            "Tác giả",
            "PLOS ONE",
        ];
        foreach ($value as $key => $value_array) {
            $value[$key] = str_replace($parent_replace_array, "", $value_array);
        }

        //Clean array
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
