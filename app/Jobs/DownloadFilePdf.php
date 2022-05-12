<?php

namespace App\Jobs;

use App\Models\Document;
use App\Services\DocumentManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Log;
use Throwable;
use Exception;

class DownloadFilePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Document $document;

    protected string $download_link;

    public int $tries = 3;

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
        try {
            DocumentManager::savePdf($this->document, $this->download_link);
        } catch
        (Exception $e) {
            // bird is clearly not the word
            $this->failed($e);
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
