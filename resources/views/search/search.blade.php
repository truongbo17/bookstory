@extends('main')

@section('title', 'Search')

@push('css')
@endpush

@push('seo')
    <meta name="description"
          content="{{__('Bookstory - The free ebook library has more than 50000000 titles to read online, read stories online, download stories, download books for free. The free bookstore comes in a variety of formats to read on a variety of devices.')}}">
    <meta name="keywords" content="pdf free download,free upload docment,bookstory,pdf free reading online">
    <meta property="og:title" content="Bookstory - {{__('Search')}} : {{$q}}"/>
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
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 flex overflow-hidden">
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative z-0 focus:outline-none">
                <div class="max-w-7xl pt-4 mx-auto pl-4 sm:pl-6 md:pl-8">
                    <h1 class="text-2xl font-semibold text-gray-900">{{__('Search')}} : {{$q}}</h1>
                </div>
                <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                    <div class="py-4">
                        <div class="md:grid md:grid-cols-3 gap-4">
                            <div class="col-span-2 border-4 border-dashed border-gray-200 rounded-lg mb-4">
                                @if(count($data_document) < 1)
                                    <div class="sm:ml-6 py-10">
                                        <div class="sm:pl-6">
                                            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-2xl">{{__('There are no matching documents, please try again')}}</h2>
                                        </div>
                                        <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                                            <a href="{{route('home.index')}}"
                                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Go back home
                                            </a>
                                            <a href="{{route('contact.index')}}"
                                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Contact support
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <section class="text-gray-600 body-font">
                                    <div class="container px-5 py-2 mx-auto flex flex-wrap">
                                        @foreach($data_document as $document)
                                            <div class="p-4 w-full">
                                                <div
                                                    class="md:grid md:grid-cols-4 gap-2 flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                                    <div
                                                        class="col-span-1 w-30 h-30 sm:mr-8 sm:mb-0 mb-4">
                                                        <img class="w-full h-auto"
                                                             @if(isset($document['image']))
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
                            <div class="col-span-1">
                                <h4 class="pl-4 mt-4 text-xl font-semibold text-gray-900">{{__('Related keywords')}}</h4>
                                <ul role="list" class="divide-y divide-gray-200">
                                    @foreach($data_seo_keyword as $seo_keyword)
                                        <li class="py-4 flex">
                                            <div class="ml-8 w-full">
                                                <a href="{{route('related.show_detail',$seo_keyword['slug'])}}">
                                                    <p class="text-sm font-medium text-gray-900">{!! $seo_keyword['title']!!}</p>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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
