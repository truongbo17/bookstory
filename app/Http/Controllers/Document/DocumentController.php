<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ->where('status', 1)
            ->with('keywords')
            ->with('users')
            ->first();

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

        return view('documents.detail', compact('document', 'link'));
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
        $documents = Document::where('status', 1)->paginate(8);
        $count_documents = Document::count();

        return view('documents.list', compact('documents','count_documents'));
    }
}
