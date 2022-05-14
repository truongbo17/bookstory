<?php

namespace App\Http\Controllers\Document;

use App\Crawler\Enum\Status;
use App\Http\Controllers\Controller;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class DocumentController extends Controller
{
    public function showDetail($document_slug)
    {
        $document = Document::where('slug', $document_slug)
            ->where('status', Status::ACTIVE)
            ->with('keywords')
            ->with('users')
            ->with('reviews')
            ->first();

        if (!$document) abort(404);

        $array_star = Document::where('slug', $document_slug)
            ->where('status', Status::ACTIVE)
            ->withCount('oneStar')
            ->withCount('twoStar')
            ->withCount('threeStar')
            ->withCount('fourStar')
            ->withCount('fiveStar')
            ->first()
            ->toArray();

        $array_star = array_slice($array_star, -5); //Số star (1,2,3,4,5) ở document
        $count_star = array_sum($array_star); //Tong tat ca cac
        if ($count_star == 0) $count_star = 0.01; //Fix loi divide zero
        $total_star = 5; //co 5 star
        $avg_star = (5 * $array_star['five_star_count']
                + 4 * $array_star['four_star_count']
                + 3 * $array_star['three_star_count']
                + 2 * $array_star['two_star_count']
                + 1 * $array_star['one_star_count']) / ($count_star);

        $percent = [
            'one_star' => round($array_star['one_star_count'] / $count_star * 100, 2),
            'two_star' => round($array_star['two_star_count'] / $count_star * 100, 2),
            'three_star' => round($array_star['three_star_count'] / $count_star * 100, 2),
            'four_star' => round($array_star['four_star_count'] / $count_star * 100, 2),
            'five_star' => round($array_star['five_star_count'] / $count_star * 100, 2),
        ];

        $star = [
            'array_star' => $array_star,
            'count_star' => $count_star,
            'total_star' => $total_star,
            'avg_star' => $avg_star,
            'percent' => $percent,
        ];

        if (!$document) abort(404);

        $document->view = $document->view + 1;
        $document->save();

        if (!$document) {
            return abort(404);
        }

        $download_link = DiskPathInfo::parse($document->download_link)->tempUrl(now()->addMinutes(config('crawl.timeout.download')), ['action' => 'download', 'slug' => $document->slug]);
        $read_link = DiskPathInfo::parse($document->download_link)->tempUrl(now()->addMinutes(config('crawl.timeout.read')), ['action' => 'read', 'slug' => $document->slug]);

        return view('documents.detail', compact('document', 'download_link', 'read_link', 'star'));
    }

    public function handle(Request $request)
    {
        $slug = $request->input('slug') . '.pdf';

        if ($request->input('action') == 'download') {
            $document = Document::where('slug', $request->input('slug'))->first();
            $document->download = ($document->download ?? 0) + 1;
            $document->save();
            $path = $request->input('path');
            return Storage::disk(config('crawl.document_disk'))->download($path, $slug);
        } else if ($request->input('action') == 'read') {
            $path = $request->input('path');
            $content = Storage::disk(config('crawl.document_disk'))->get($path);
            return response($content, 200, [
                'Content-Type' => 'application/pdf',
            ]);
        }
        return false;
    }

    public function list()
    {
        $count_documents = Document::count();
        $perpage = request()->get('perpage', 12);

        $documents = Document::ignoreRequest(['perpage'])
            ->AcceptRequest(['sort', 'author', 'count_page', 'perpage', 'page'])
            ->where('status', Status::ACTIVE)
            ->filter()
            ->paginate($perpage, ['*'], 'page');

        return view('documents.list', compact('documents', 'count_documents'));
    }
}
