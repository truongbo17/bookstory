<?php

namespace App\Crawler\HandlePdf;

use App\Libs\IdToPath;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class PdfToImage
{
    protected string $disk_document; //disk save document
    protected string $file_name; //file name save pdf tạm thời (tất cả các document thay nhau lưu ở đây)
    protected string $disk_image; //Disk image document
    protected string $ext_image; //Lưu ảnh dưới dạng

    public function __construct()
    {
        $this->disk_document = config('crawl.pdf_to_image.disk_document');
        $this->file_name = config('crawl.pdf_to_image.file_name');
        $this->disk_image = config('crawl.pdf_to_image.disk_image');
        $this->ext_image = config('crawl.pdf_to_image.ext_image');
    }

    public function savePdf(string $download_link)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $contents = file_get_contents($download_link, false, stream_context_create($arrContextOptions));

        Storage::disk($this->disk_document)->put($this->file_name, $contents);
    }

    public function saveImageFromPdf(Document $document)
    {
        $link = Storage::disk($this->disk_document)->path($this->file_name);
        $pdf = new Pdf($link);

        $path = IdToPath::make($document->id, $this->ext_image);
        $path_info = Storage::disk($this->disk_image)->path($path);

        //Fake path vì saveImage dùng file_put_content nên không tự tạo dir được (000/001/1.png)
        Storage::disk($this->disk_image)->put($path, '');

        $pdf->width(500)
            ->saveImage($path_info);

        return [
            'image' => config('crawl.public_link_document_image') . '/' . $path,
            'page' => $pdf->getNumberOfPages() ?? 0,
        ];
    }
}
