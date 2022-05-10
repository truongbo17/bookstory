@extends('main')

@section('title', __('Read and download documents for free'))

@push('css')
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
