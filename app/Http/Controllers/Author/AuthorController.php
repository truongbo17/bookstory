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

        $authors = User::where('is_admin', 0)
            ->withCount('documents')
            ->AcceptRequest(['sort', 'count_document', 'perpage', 'page'])
            ->ignoreRequest(['perpage'])
            ->where('status', UserStatus::ACTIVE)
            ->filter()
            ->paginate($perpage, ['*'], 'page');

        return view('authors.list', compact('authors', 'count_authors'));
    }

    public function showDetail(Request $request, $author_id)
    {
        $start_limit = 0;
        if ($request->document_page != null) $start_limit = $request->document_page;
        User::findOrFail($author_id);
        $author = User::where('id', $author_id)
            ->with(['documents' => function ($query) use ($start_limit) {
                $query->where('status', Status::ACTIVE)->skip($start_limit)->take(5)->get();
            }])
            ->withCount('documents')
            ->get();

        return view('authors.detail', compact('author'));
    }
}
