@extends('main')

@section('title', 'Search')

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 flex overflow-hidden">
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative z-0 focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{__('Search')}}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <div class="py-4">
                            <div class="md:grid md:grid-cols-3 gap-4">
                                <div class="col-span-2 border-4 border-dashed border-gray-200 rounded-lg h-96 mb-4">
                                {{--search--}}
                                </div>
                                <div class="col-span-1 border-4 border-dashed border-gray-200 rounded-lg h-96">
                                    {{--keyword--}}
                                </div>
                            </div>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection

@push('javascript')
@endpush
