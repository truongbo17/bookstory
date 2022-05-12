<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\SeoKeyword;
use Illuminate\Http\Request;
use ElasticScoutDriverPlus\Support\Query;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if (!$request->q) abort(404);

        $q = $request->q;
        $query = Query::multiMatch()
            ->fields(['title', 'content'])
            ->query($request->q);

        $search_result_document = Document::searchQuery($query)
            ->highlightRaw([
                "pre_tags" => ["<b>"],
                "post_tags" => ["</b>"],
                'fields' =>
                    [
                        'title' => ['number_of_fragments' => 0],
                        'content' => ['number_of_fragments' => 3],
                    ]
            ])
            ->paginate(10);

        $search_result_seo_keyword = SeoKeyword::searchQuery($query)
            ->highlightRaw([
                "pre_tags" => ["<b>"],
                "post_tags" => ["</b>"],
                'fields' =>
                    [
                        'title' => ['number_of_fragments' => 0],
                    ]
            ])
            ->paginate(10);

        $hits_document = $search_result_document->hits();
        $hits_highlights = $search_result_document->highlights();
        $data_document = [];
        foreach ($hits_highlights as $key => $highlight) {
            if (!array_key_exists('title', $highlight->raw())) {
                $data_document[$key]['title'] = $hits_document[$key]->document()->content()['title'];
            } else {
                $data_document[$key]['title'] = implode("...", $highlight->raw()['title']);
            }

            if (!array_key_exists('content', $highlight->raw())) {
                $data_document[$key]['content'] = $hits_document[$key]->document()->content()['content'];
            } else {
                $data_document[$key]['content'] = implode("...", $highlight->raw()['content']);
            }

            $data_document[$key]['document_id'] = $hits_document[$key]->document()->content()['document_id'];
            $data_document[$key]['slug'] = $hits_document[$key]->document()->content()['slug'];
            $data_document[$key]['image'] = $hits_document[$key]->document()->content()['image'] ?? null;
        }

        $data_seo_keyword = [];
        $hits_seo_keyword = $search_result_document->hits();
        $hits_highlights_seo_keyword = $search_result_document->highlights();
        foreach ($hits_highlights_seo_keyword as $key => $highlight) {
            if (!array_key_exists('title', $highlight->raw())) {
                $data_seo_keyword[$key]['title'] = $hits_seo_keyword[$key]->document()->content()['title'];
            } else {
                $data_seo_keyword[$key]['title'] = implode("...", $highlight->raw()['title']);
            }
            $data_seo_keyword[$key]['slug'] = $hits_seo_keyword[$key]->document()->content()['slug'];
        }

        return view('search.search', compact('q', 'data_document', 'data_seo_keyword'));
    }
}
