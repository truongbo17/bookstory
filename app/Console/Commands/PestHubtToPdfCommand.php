<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PestHubtToPdfCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:pest
    {--file= : file php array data}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert array data of pesthubt to file PDF';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->option('file');

        $file = include('/home/truongbo/Downloads/quizs.php');

        $file = $file[0]['content'];
        $file = explode('\r\n', $file);

        $counter = 1;
        foreach ($file as $line) {
            if (trim($line) != '') {
                $blocks[$counter][] = $line;
            } else {
                $counter++;
            }
        }
        $data = [];
        $patterns = ['A.' => 'A', 'B.' => 'B', 'C.' => 'C', 'D.' => 'D', 'E.' => 'E'];
        foreach ($blocks as $question_no => $lines) {
            foreach ($lines as $key => &$line) {
                if (preg_match('/(' . implode('|', array_keys($patterns)) . ')/', $line, $matches)) {
                    $data[$question_no]['answers'][$patterns[$matches[0]]] = $line;
                    if (preg_match('/\*' . $matches[0] . '/', $line)) {
                        $data[$question_no]['correct'] = $patterns[$matches[0]];
                        $data[$question_no]['answers'][$patterns[$matches[0]]] = preg_replace('/\*/', '', $line);
                    }
                    unset($lines[$key]);
                }
                $data[$question_no]['question'] = implode('', $lines);
            }
        }
        dd($data);

        return self::SUCCESS;
    }
}
