<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function show($document_slug)
    {
        $document = Document::where('slug', $document_slug)->first();

        return view('documents.detail', compact('document'));
    }
}
