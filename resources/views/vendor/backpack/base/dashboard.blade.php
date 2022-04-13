@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'BookStory - Trang quản trị',
        'content'     => 'Quản lý hệ thống Crawl , Upload, Search, Store Data của bạn',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
@endphp

@section('content')
@endsection
