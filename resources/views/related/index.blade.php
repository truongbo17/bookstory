@extends('main')

@section('title', __('Keyword : ').$title)

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
                <div class="max-w-7xl pt-4 mx-auto pl-4 sm:pl-6 md:pl-8">
                    <h1 class="text-2xl font-semibold text-gray-900">{{__('Keyword : ').$title}}</h1>
                </div>
                <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                    <div class="py-4">
                        <div class="">
                            <div class="border-4 border-dashed border-gray-200 rounded-lg mb-4">
                                <section class="text-gray-600 body-font">
                                    <div class="container px-5 py-2 mx-auto flex flex-wrap">
                                        @foreach($data as $document)
                                            <div class="p-4 w-full">
                                                <div
                                                    class="md:grid md:grid-cols-4 gap-2 flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                                    <div
                                                        class="col-span-1 w-30 h-30 sm:mr-8 sm:mb-0 mb-4">
                                                        <img class="w-full h-auto"
                                                             @if(!is_null($document['image']) || count($document['image']) > 0)
                                                                 src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse($document['image'])->path())}}"
                                                             @else
                                                                 src="{{asset('images/avatar/default.png')}}"
                                                             @endif
                                                             alt="{{$document['title']}}">
                                                    </div>
                                                    <div class="col-span-3 flex-grow">
                                                        <a href="{{route('document.show_detail',$document['slug'])}}">
                                                            <h2 class="text-gray-700 text-sm title-font font-medium mb-3">
                                                                {!! $document['title'] !!}</h2>
                                                            <p class="text-gray-500 leading-relaxed text-sm">{!! $document['content'] !!}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </div>
@endsection

@push('javascript')
@endpush
