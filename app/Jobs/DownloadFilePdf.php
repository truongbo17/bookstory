<?php

namespace App\Jobs;

use App\Models\Document;
use App\Services\DocumentManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class DownloadFilePdf implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Document $document;

    protected string $download_link;

    public int $tries = 3;

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return $this->document->id;
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Document $document, string $download_link)
    {
        $this->onQueue('handle_pdf');
        $this->document = $document;
        $this->download_link = $download_link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DocumentManager::savePdf($this->document, $this->download_link);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
//    public function middleware()
//    {
//        return [new WithoutOverlapping($this->document->id)];
//    }
}
