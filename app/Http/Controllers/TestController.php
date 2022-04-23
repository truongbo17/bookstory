<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test()
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();
        $page = $browser->newPage();
        $page->goto('https://5pdf.org/book/3939');

        $divs = $page->querySelectorAll('div');

        foreach ($divs as $div) {
            $text = $div->evaluate(JsFunction::createWithParameters(['node'])
                ->body('return node.innerText;'));

            dump($text);
        }

        dump($divs);

        $browser->close();
    }

    public function pdftoimage()
    {
        $link = Storage::disk('document')->path('test.pdf');
        $pdf = new Pdf($link);
        $pdf->saveImage();
    }

    public function downloadpdf()
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $contents = file_get_contents("https://journals.plos.org/plosone/article/file?id=10.1371/journal.pone.0000686&type=printable", false, stream_context_create($arrContextOptions));

        Storage::disk('document')->put('document.pdf', $contents);
    }

    public function viewpdf(){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $contents = file_get_contents("https://journals.plos.org/plosone/article/file?id=10.1371/journal.pone.0000686&type=printable", false, stream_context_create($arrContextOptions));

        return view('test');
    }
}
