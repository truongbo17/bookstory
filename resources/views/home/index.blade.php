@extends('main')

@section('title', __('Read and download documents for free'))

@push('css')
@endpush

@push('seo')
    <meta name="description"
          content="{{__('Bookstory - The free ebook library has more than 50000000 titles to read online, read stories online, download stories, download books for free. The free bookstore comes in a variety of formats to read on a variety of devices.')}}">
    <meta name="keywords" content="pdf free download,free upload docment,bookstory,pdf free reading online">
    <meta property="og:title" content="{{__('Read and download documents for free')}}"/>
    <meta property="og:image" content="{{asset('images/preview/image-preview.png')}}"/>
    <meta property="og:type" content="books.book"/>
    <meta property="og:description"
          content="{{__('Bookstory - The free ebook library has more than 50000000 titles to read online, read stories online, download stories, download books for free. The free bookstore comes in a variety of formats to read on a variety of devices.')}}"/>
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:locale" content="{{__('locale')}}"/>
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('preview')
    @include('home.preview')
@endsection

@section('main')
    @include('home.popular_documents')
@endsection

@section('sub_main')
    @include('home.overview')
@endsection

@push('javascript')
@endpush
