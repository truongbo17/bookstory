<?php

namespace App\Console\Commands;

use App\Crawler\Enum\DataStatus;
use App\Models\Document;
use Illuminate\Console\Command;

class RandomViewDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'random:number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Random view and download document';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Document::where('status', DataStatus::HAS_DATA)
            ->chunkById(100, function ($documents) {
                foreach ($documents as $document) {
                    $this->info('Generate view and download of document' . $document->title);
                    $document->view = $document->view + rand(10000, 100000);
                    $document->download = $document->download + rand(500, 1000);

                    $this->info('View : '.$document->view);
                    $this->info('Download : '.$document->download);

                    $check = $document->save();
                    if ($check) $this->info('Success generate view an download...');
                }
            });

        return self::SUCCESS;
    }
}
