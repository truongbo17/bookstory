<?php

namespace App\Crawler\Browsers;

interface BrowserInterface
{
    /*
     * getHtml function
     *
     * @param string $url
     * @return mixed
     * */
    public function getHtml(string $url);
}
