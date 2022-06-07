<?php

namespace App\Crawler\Browsers;

use Spatie\Browsershot\Browsershot as BrowserS;

class BrowserShot implements BrowserInterface
{
    public function getHtml(string $url)
    {
        return BrowserS::url($url)->bodyHtml();
    }
}
