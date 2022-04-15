<?php

namespace App\Crawler\Browsers;

use App\Crawler\Exception\NotFoundBrowserDriver;

final class BrowserManager
{
    protected static string $driver;

    /*
     * get function
     *
     * @param string $driver
     * @return BrowserInterface
     * */
    public static function get(string $driver = 'guzzle'): BrowserInterface
    {
        if (empty(self::$driver) || self::$driver != $driver) {
            self::$driver = $driver;
        }

        return self::makeBrowser();
    }

    /*
     * makeBrowser function
     *
     * @param string $driver
     * @return BrowserInterface
     * @throw NotFoundBrowserDriver
     * */
    public static function makeBrowser(): BrowserInterface
    {
        return match (self::$driver) {
            'guzzle' => new Guzzle(),
            'puppeteer' => new Puppeteer(),
            'browserless' => new Browserless(),
            default => throw new NotFoundBrowserDriver("No browser match with driver " . self::$driver),
        };
    }
}
