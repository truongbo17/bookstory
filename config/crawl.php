<?php

return [
    /*
     * Disk storage
     * Path data
     * */
    'document_disk' => env('DOCUMENT_DISK', 'data'),
    'path' => [
        'avatar_user' => 'avatar',
        'document_pdf' => 'document',
        'document_image' => 'document_image',
        'import_json_urls' => 'import_json_urls',
        'content_file' => 'content',
    ],
    'public_link_storage' => env('PUBLIC_LINK_STORAGE', 'storage/data/'),
//-------------------------------------------------------------------------------------
    /*
     * Crawler
     * */
    'driver_browser' => env('DRIVER_BROWSER', 'guzzle'),
    'should_get_data' => [
        'title',
        'download_link',
        'content',
    ],
    'browsers' => [
        'puppeteer' => [
            'timeout' => env('BROWSER_TIMEOUT', 120),
            'verify' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            ],
            'http_errors' => false,
            'allow_redirects' => [
                'track_redirects' => true
            ],
            'proxy' => env('BROWSER_PROXY', 'http://210.245.74.57:6056'),
        ],
        'chrome' => [],
        'guzzle' => [
            'timeout' => env('BROWSER_TIMEOUT', 120),
            'verify' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            ],
            'http_errors' => false,
            'allow_redirects' => [
                'track_redirects' => true
            ],
            'proxy' => env('BROWSER_PROXY', 'http://210.245.74.57:6056'),
        ],
    ],
    'should_retry_status_codes' => [
        408, // Request Timeout
        429, // Too Many Requests
        509, // Bandwidth Limit Exceeded (Apache)
    ],
//-------------------------------------------------------------------------------------
];
