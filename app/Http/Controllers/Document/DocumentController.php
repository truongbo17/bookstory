<?php

namespace App\Http\Controllers\Document;

use App\Crawler\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class DocumentController extends Controller
{
    public array $arrContextOptions = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ];

    public function showDetail($document_slug)
    {
        $document = Document::where('slug', $document_slug)
            ->where('status', Status::ACTIVE)
            ->with('keywords')
            ->with('users')
            ->with('reviews')
            ->first();

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

        //Save file PDF để hiển thị
        $file = 'read_document.pdf';
        $contents = file_get_contents($document->download_link, false, stream_context_create($this->arrContextOptions));
        Storage::disk('document')->put($file, $contents);
        $link = asset('document/' . $file);

        return view('documents.detail', compact('document', 'link', 'star'));
    }

    public function download($document_id)
    {
        $document = Document::findOrFail($document_id);
        $document->download = $document->download + 1;
        $document->save();

        $filename = $document->slug . '.' . $document->binding;
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($document->download_link, $tempImage, stream_context_create($this->arrContextOptions));

        return response()->download($tempImage, $filename);
    }

    public function list()
    {
        $count_documents = Document::count();
        $perpage = request()->get('perpage', 12);

        $documents = Document::ignoreRequest(['perpage'])->where('status', Status::ACTIVE)
            ->filter()
            ->paginate($perpage, ['*'], 'page');

        return view('documents.list', compact('documents', 'count_documents'));
    }
}
