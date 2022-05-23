<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\DiskPathTools\DiskPathInfo;
use Illuminate\Http\Request;

class PdfToImage extends Controller
{
    public function pdfToImage(Request $request)
    {
        $download_link = DiskPathInfo::parse($request->download_link)->path();
        return view('pdf.pdftoimage', compact('download_link'));
    }
}
