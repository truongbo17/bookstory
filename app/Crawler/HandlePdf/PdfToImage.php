<?php

namespace App\Crawler\HandlePdf;

use App\Crawler\Browsers\Guzzle;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class PdfToImage
{
    public function savePdf(int $id, string $download_link)
    {
//        $arrContextOptions = array(
//            "ssl" => array(
//                "verify_peer"=>false,
//                "verify_peer_name"=>false,
//            ),
//        );
//        $contents = file_get_contents($download_link, false, stream_context_create($arrContextOptions));
        $contents = (new Guzzle())->getContent($download_link);

        $file_name = IdToPath::make($id, 'pdf');
        $file_name = new DiskPathInfo(config('crawl.pdf_disk'), config('crawl.path.document_pdf') . '/' . $file_name);
        $file_name->put($contents);

        return $file_name;
    }

    public function saveImageFromPdf(Document $document)
    {
        $path_document = DiskPathInfo::parse($document->download_link)->path();
        $link = Storage::disk(config('crawl.pdf_disk'))->path($path_document);
        $pdf = new Pdf($link);

        $file_name = IdToPath::make($document->id, 'png');
        $file_name = new DiskPathInfo(config('crawl.document_disk'), config('crawl.path.document_image') . '/' . $file_name);
        $file_name->put('');

        $path = Storage::disk(config('crawl.document_disk'))->path($file_name->path());

        $pdf->setOutputFormat('png')
            ->width(500)
            ->saveImage($path);

        return [
            'image' => $file_name,
            'count_page' => $pdf->getNumberOfPages() ?: 0,
        ];
    }
}
