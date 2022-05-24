<?php

namespace App\Jobs;

use App\Crawler\Enum\DataStatus;
use App\Crawler\HandlePdf\PdfToImage;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Models\CrawlUrl;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class PestHubtHandle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Document $document;

    protected $crawl_url;

    protected array $data;

    public int $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Document $document, $crawl_url, array $data)
    {
        $this->onQueue('pesthubt_handle');
        $this->document = $document;
        $this->data = $data;
        $this->crawl_url = $crawl_url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $data_pdf = [
                'title' => $this->data['title'],
                'quizs' => $this->data['quiz_content'],
            ];
            $pdf = PDF::loadView('pdf.pest', $data_pdf);

            $file_name = IdToPath::make($this->document->id, 'pdf');
            $file_name = new DiskPathInfo(config('crawl.document_disk'), config('crawl.path.document_pdf') . '/' . $file_name);
            $file_name->put($pdf->output());
            $this->document->download_link = $file_name;

            $pdf_to_image = new PdfToImage();
            $pdf_to_image = $pdf_to_image->saveImageFromPdf($this->document);

            $this->document->image = $pdf_to_image['image'];
            if (is_null($this->document->count_page)) $this->document->count_page = $pdf_to_image['count_page'];

            if ($this->document->save()) {
                CrawlUrl::find($this->crawl_url['id'])->update(['data_status' => DataStatus::HAS_DATA]);
            } else {
                CrawlUrl::find($this->crawl_url['id'])->update(['data_status' => DataStatus::GET_DATA_ERROR]);
            }
        } catch (Exception $exception) {
            \Log::error($exception);
            CrawlUrl::find($this->crawl_url['id'])->update(['data_status' => DataStatus::GET_DATA_ERROR]);
        }
    }

    /**
     * Handle a job failure.
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        Log::error($exception);
    }
}
