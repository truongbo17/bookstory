<?php

use App\Crawler\Browsers\Guzzle;
use App\Models\Document;
use App\Models\SeoKeyword;
use Illuminate\Support\Str;
use PackageVersions\Versions;

function backpack_pro()
{
    return Versions::getVersion('backpack/crud');
}

function createSlug(string $title): string
{
    $slug = Str::slug($title);
    $check_slug_document = Document::where('slug', $slug)->exists();
    $check_slug_seo_keyword = SeoKeyword::where('slug', $slug)->exists();
    if ($check_slug_document || $check_slug_seo_keyword) {
        $slug = $slug . '-' . time() . mt_rand();
    }

    return $slug;
}

function getCountPagePdf(string $content_path,string $type = 'path')
{
    if($type == 'path'){
        $content_path = (new Guzzle())->getContent($content_path);
    }
    $num = preg_match_all("/\/Page\W/", $content_path, $dummy);

    return $num ?? config('crawl.default_pdf_count_page');
}
