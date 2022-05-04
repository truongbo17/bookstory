<?php

namespace App\Http\Controllers\Author;

use App\Crawler\Enum\Status;
use App\Crawler\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function list()
    {
        $count_authors = User::count();

        $perpage = request()->get('perpage', 12);

        $authors = User::withCount('documents')
            ->ignoreRequest(['perpage'])
            ->where('status', UserStatus::ACTIVE)
            ->filter()
            ->paginate($perpage, ['*'], 'page');

        return view('authors.list', compact('authors', 'count_authors'));
    }

    public function showDetail($author_id)
    {
        User::findOrFail($author_id);
        $author = User::where('id', $author_id)->with(['documents' => function ($query) {
            $query->where('status', Status::ACTIVE)->paginate(5);
        }])->get();

        return view('authors.detail', compact('author'));
    }
}
