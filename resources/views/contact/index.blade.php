@extends('main')

@section('title', 'Contact us')

@push('css')
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
