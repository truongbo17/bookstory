<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class TestController extends Controller
{
    public function test()
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch();
        $page = $browser->newPage();
        $page->goto('https://5pdf.org/book/3939');

        $divs = $page->querySelectorAll('div');

        foreach($divs as $div){
            $text = $div->evaluate(JsFunction::createWithParameters(['node'])
                ->body('return node.innerText;'));

            dump($text);
        }

        dump($divs);

        $browser->close();
    }
}
