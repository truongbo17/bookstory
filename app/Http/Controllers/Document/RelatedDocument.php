<?php

namespace App\Http\Controllers\Document;

use App\Crawler\Enum\Status;
use App\Http\Controllers\Controller;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Models\SeoKeyword;
use Illuminate\Http\Request;

class RelatedDocument extends Controller
{
    public function showDetail($related_slug)
    {
        $related = SeoKeyword::where('slug', $related_slug)
            ->where('status', Status::ACTIVE)
            ->first();

        if (!$related) abort(404);

        $related->view = $related->view + 1;
        $related->save();

        $data = DiskPathInfo::parse($related->hits)->read();
        $related->data = $data;

        return view('related.index', compact('related'));
    }
}
