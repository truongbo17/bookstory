<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class TestController extends Controller
{
    public function test()
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();
        $page = $browser->newPage();
        $page->goto('https://nhasachmienphi.com/bach-khoa-ve-vitamin.html');

        $html = '';

        $divs = $page->querySelectorAll('html');

        foreach ($divs as $div) {
            $html = $div->evaluate(JsFunction::createWithParameters(['node'])
                ->body('return node.innerHTML;'));
        }

        $browser->close();


        $title = 'body > div:nth-child(3) > div > div.col-xs-12.col-sm-8.col-md-8.col-lg-8 > div.content_page.pd-20 > div.row > div.col-xs-12.col-sm-4.col-md-4.col-lg-4 > img';

         $dom_crawler = new DomCrawler($html);
        $linkCrawler = $dom_crawler->filter($title)->attr('src');

        dump($linkCrawler);
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
