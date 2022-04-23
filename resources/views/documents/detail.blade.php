@extends('main')

@section('title', $document->title)

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')

@endsection

@push('javascript')
@endpush
