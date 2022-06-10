<?php

namespace App\Crawler\Browsers;

use Nesk\Puphpeteer\Puppeteer as Pup;
use Nesk\Rialto\Data\JsFunction;

class Puppeteer implements BrowserInterface
{
    public Pup $puppeteer;

    public function __construct(?Pup $puppeteer = null)
    {
        if ($puppeteer) {
            $this->puppeteer = $puppeteer;
        } else {
            $this->puppeteer = new Pup(config('crawl.browsers.puppeteer.config'));
        }
    }

    public function getHtml(string $url)
    {
        $browser = $this->puppeteer->launch(config('crawl.browsers.puppeteer.launch'));
        $page = $browser->newPage();
        $page->goto($url);

        $divs = $page->querySelectorAll('html');

        foreach ($divs as $div) {
            $html = $div->evaluate(JsFunction::createWithParameters(['node'])
                ->body('return node.innerHTML;'));
        }
        $browser->close();

        return $html;
    }
}
