<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStory - @yield('title')</title>
    <meta name=”robots” content=”all”/>
    <meta http-equiv=”content-language” content=”{{__('lang')}}”/>
    @stack('seo','<meta name="description" content="Bookstory it is contains Great selection of modern and classic books waiting to be discovered. All free and available in PDF Files.">
    <meta name="keywords" content="bookstory,tai liệu miễn phí,tai lieu mien phi,PDF Free Download,tải lên tài liệu,upload free">
')
    <link rel="icon" type="image/png" href="{{ asset('') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css"/>
    <link href="{{ asset('1/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
