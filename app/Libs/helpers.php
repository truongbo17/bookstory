<?php

use App\Models\Document;
use Illuminate\Support\Str;

function backpack_pro () {
    return \PackageVersions\Versions::getVersion('backpack/crud');
}

function createSlug(string $title): string
{
    $slug = Str::slug($title);
    $check_slug = Document::where('slug', $slug)->exists();
    if ($check_slug) {
        $slug = $slug . '-' . time() . mt_rand();
    }

    return $slug;
}
