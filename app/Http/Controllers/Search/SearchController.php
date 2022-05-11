<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use ElasticScoutDriverPlus\Support\Query;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->q) {
            $q = $request->q;
            $query = Query::multiMatch()
                ->fields(['title', 'content'])
                ->query($request->q);

            $searchResult = Document::searchQuery($query)
                ->highlightRaw([
                    "pre_tags" => ["<b>"],
                    "post_tags" => ["</b>"],
                    'fields' =>
                        [
                            'title' => ['number_of_fragments' => 0],
                            'content' => ['number_of_fragments' => 0],
                        ]
                ])
                ->execute();
            $data = $searchResult->hits();

            $highlights = $searchResult->highlights();

            dd(compact('data', 'highlights', 'q'));

            return view('search.search', compact('data', 'highlights', 'q'));
        }
    }
}
