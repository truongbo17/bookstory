@extends('main')

@section('title', __('Contact us'))

@push('css')
@endpush

@push('seo')
    <meta name="description"
          content="{{__('Bookstory - The free ebook library has more than 50000000 titles to read online, read stories online, download stories, download books for free. The free bookstore comes in a variety of formats to read on a variety of devices.')}}">
    <meta name="keywords" content="pdf free download,free upload docment,bookstory,pdf free reading online">
    <meta property="og:title" content="Bookstory - {{__('Contact us')}}"/>
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

@section('main')
    @include('contact.form')
@endsection

@push('javascript')
@endpush
