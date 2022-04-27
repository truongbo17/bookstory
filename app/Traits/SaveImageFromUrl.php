<?php

namespace App\Traits;

use App\Crawler\HandlePdf\PdfToImage;
use App\Libs\IdToPath;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Intervention\Image\Facades\Image;

trait SaveImageFromUrl
{
    public function saveImage(Document $document, string $url, string $disk, string $bindding = 'PDF')
    {
        $image = '';
        $count_page = 0;

        switch ($bindding) {
            case 'PDF' :
                $pdf_to_image = new PdfToImage();
                try {
                    $pdf_to_image->savePdf($url);
                    $pdf_to_image = $pdf_to_image->saveImageFromPdf($document);

                    $image = $pdf_to_image['image'];
                    $count_page = $pdf_to_image['count_page'];
                } catch (Exception $e) {
                    Log::error($e);
                    $image = $this->titleToImgae($document);
                }
                break;

            case 'DOCX':
                $image = $this->titleToImgae($document);
                break;
        }

        if (!is_null($document->image)){
            $contents = Image::make($url)->fit(300);

            $path = IdToPath::make($document->id, config('crawl.pdf_to_image.ext_image'));

            if (Storage::disk($disk)->put($path, $contents)) {
                $image = config('crawl.public_link_document_image') . '/' . $path;
            } else {
                $image = $this->titleToImgae($document);
            }

        }

        return [
            'image' => $image,
            'count_page' => $count_page,
        ];
    }

    public function titleToImgae(Document $document)
    {
        return true;
    }

}
