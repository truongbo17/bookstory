<?php

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

function getCountPagePdf(string $path)
{
    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );

    $pdftext = file_get_contents($path, false, stream_context_create($arrContextOptions));
    $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);

    return $num ?? config('crawl.default_pdf_count_page');
}
