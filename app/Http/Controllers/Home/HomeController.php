<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Document;
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

        $count_user = User::count();
        $count_document = Document::count();

        return view('home.index', compact('documents', 'count_user', 'count_document'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
