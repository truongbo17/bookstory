<?php

namespace App\Http\Controllers\Author;

use App\Crawler\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function list()
    {
        $authors = User::where('status', UserStatus::ACTIVE)
            ->withCount('documents')
            ->paginate(8);
        $count_authors = User::count();

        return view('authors.list', compact('authors', 'count_authors'));
    }

    public function showDetail($author_id)
    {
        $author = User::findOrFail($author_id);

        return view('authors.detail', compact('author'));
    }
}
