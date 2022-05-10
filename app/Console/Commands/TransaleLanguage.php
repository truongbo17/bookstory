<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TransaleLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tran:lang
    {--source: link json source language converted}
    {--target: target language}
    {--source_target: target save file json}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate language';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = 'en';
        $file_name = $this->argument('source') ?? '/var/www/bookstory.test/lang/vi.json';
        $target = $this->argument('target') ?? 'en';
        $file_output = $this->argument('source_target') ?? '/var/www/bookstory.test/lang/en.json';

        $json = file_get_contents($file_name);

        $data = json_decode($json, true);
        $new_data = [];

        foreach ($data as $key => $value) {
            $new_data[$key] = GoogleTranslate::trans($key, $target, $source);
        }

        $target_json = json_encode($new_data);
        file_put_contents($file_output, $target_json);
    }
}
