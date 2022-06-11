<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStory - @yield('title')</title>
    <meta name="google-site-verification" content="C9aBycPGfUFFJ-UPegHJ2970JmiJH22WbeEEuuCU8cM"/>
    <meta name=”robots” content=”all”/>
    <meta http-equiv=”content-language” content=”{{__('lang')}}”/>
    @stack('seo')
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-header.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css"/>
    <link href="{{ asset('2/app.css') }}" rel="stylesheet">
    @stack('css')

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XCKX81Y594"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-XCKX81Y594');
    </script>
</head>
