<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class TestController extends Controller
{
    public function crawl()
    {
        $client = new Client(config('crawl.browsers.guzzle'));
        $response = $client->get('https://www.scirp.org/journal/paperinformation.aspx?paperid=50723');
        $html = $response->getBody()->getContents();
        $dom_crawler = new DomCrawler($html);
        $linkCrawler = $dom_crawler->filter('div#JournalInfor_div_showkeywords a')->text();

        dd($linkCrawler);
    }

    public function test()
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();
        $page = $browser->newPage();
        $page->goto('https://www.scirp.org/pdf/ojmn_2022022816255359.pdf');
        $path = '/var/www/bookstory.test/public/ex.png';
        $page->screenshot(['path' => $path]);

        $html = '';

        $divs = $page->querySelectorAll('html');

        foreach ($divs as $div) {
            $html = $div->evaluate(JsFunction::createWithParameters(['node'])
                ->body('return node.innerHTML;'));
        }

        $browser->close();
        dd($html);

//        $title = 'body > div:nth-child(3) > div > div.col-xs-12.col-sm-8.col-md-8.col-lg-8 > div.content_page.pd-20 > div.row > div.col-xs-12.col-sm-4.col-md-4.col-lg-4 > img';

        $dom_crawler = new DomCrawler($html);
        $linkCrawler = $dom_crawler->filter('section.content.container-fluid.custom-content script')->text();

        $string = preg_replace('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/','',$linkCrawler);

        $string = preg_replace('/(\s)console\.log[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/','',$string);

        $object_data = json_decode($string);

        $user_name = $object_data->quiz->user->fullname;
        $category_name = $object_data->quiz->category->category;

        $object_data->quiz->user_name = $user_name;
        $object_data->quiz->category_name = $category_name;

        $unset_key_object = [
            'category_id',
            'user_id',
            'total_question',
            'created_at',
            'viewed',
            'quiz_slug',
            'status',
            'download',
            'updated_at',
            'total_time',
            'total_grade',
            'liked_count',
            'is_liked',
            'is_favorited',
            'answer_shuffle',
            'qs_shuffle',
            'mode',
            'user',
            'category',
            'check_quiz',
        ];

        foreach ($unset_key_object as $key){
            unset($object_data->quiz->$key);
        }

        dd($object_data);
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
