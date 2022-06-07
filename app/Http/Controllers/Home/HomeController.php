<?php

namespace App\Http\Controllers\Home;

use App\Crawler\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\SeoKeyword;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $documents = Document::where('status', 1)
            ->orderBy('view', 'DESC')
            ->orderBy('download', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();

        $authors = User::where('status', 1)
            ->where('is_admin', 0)
            ->withCount('documents')
            ->orderBy('documents_count', 'DESC')
            ->limit(8)
            ->get();

        $count_user = User::count();
        $count_document = Document::count();

        $top_keyword = SeoKeyword::where('status', Status::ACTIVE)
            ->orderBy('view', 'DESC')
            ->limit(12)
            ->get();

        return view('home.index', compact('documents', 'count_user', 'count_document', 'authors', 'top_keyword'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
