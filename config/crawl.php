<?php

return [
    /*
     * Disk storage
     * Path data
     * */
    'document_disk' => env('DOCUMENT_DISK', 'data'),
    'pdf_disk' => env('PDF_DISK', 'document'),
    'path' => [
        'avatar_user' => 'avatar',
        'document_pdf' => 'document',
        'document_image' => 'document_image',
        'import_json_urls' => 'import_json_urls',
        'content_file' => 'content',
        'seo_keyword_file' => 'seo_keyword',
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
            'config' => [
                'idle_timeout' => 100,
                'read_timeout' => 50,
            ],
            'launch' => [
                'headless' => true,
                'args' => [
                    '--use-gl=egl',
                    '--no-sandbox',
                    '--disable-setuid-sandbox'
                ],
            ],
        ],
        'chrome' => [],
        'guzzle' => [
            'timeout' => env('BROWSER_TIMEOUT', 1000),
            'verify' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            ],
            'http_errors' => false,
            'allow_redirects' => [
                'track_redirects' => true
            ],
        ],
    ],
    'should_retry_status_codes' => [
        408, // Request Timeout
        429, // Too Many Requests
        509, // Bandwidth Limit Exceeded (Apache)
    ],
//-------------------------------------------------------------------------------------
    /*
     * Temp url time out (minutes)
     * */
    'timeout' => [
        'download' => 10,
        'read' => 1,
    ],
//-------------------------------------------------------------------------------------
    /*
     * default pdf count page
     * */
    'default_pdf_count_page' => 10,
    'max_pdf_count_page' => 50,
//-------------------------------------------------------------------------------------
    /*
     * Language Website
     * us,can,en,vi,fr
     * */
    'lang' => [
        'vi' => [
            'name' => 'VIE',
            'img' => env('APP_URL') . '/images/flag/vietnam.png',
            'href' => [
                'route' => 'user.change-language',
                'param' => ['vi'],
            ]
        ],
        'en' => [
            'name' => 'ENG',
            'img' => env('APP_URL') . '/images/flag/english.webp',
            'href' => [
                'route' => 'user.change-language',
                'param' => ['en'],
            ]
        ],
        'id' => [
            'name' => 'INDIA',
            'img' => env('APP_URL') . '/images/flag/indo.png',
            'href' => [
                'route' => 'user.change-language',
                'param' => ['id'],
            ]
        ],
        'fr' => [
            'name' => 'FRA',
            'img' => env('APP_URL') . '/images/flag/france.png',
            'href' => [
                'route' => 'user.change-language',
                'param' => ['fr'],
            ]
        ],
        'cn' => [
            'name' => 'CHINA',
            'img' => env('APP_URL') . '/images/flag/cn.png',
            'href' => [
                'route' => 'user.change-language',
                'param' => ['cn'],
            ]
        ],
    ]
//-------------------------------------------------------------------------------------
];
