@extends('main')

@section('title', __('List Document'))

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 h-screen flex overflow-hidden">
        @include('user.layout.sidebar')

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                <button type="button"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open sidebar</span>
                    <!-- Heroicon name: outline/menu -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{__('Dashbroad')}}
                            - {{__('List Document')}}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            <div class="border-4 border-dashed border-gray-200 rounded-lg h-full">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="mt-8 max-w-5xl mx-auto px-4 pb-12 sm:px-4 lg:px-4">

                                        <h2 class="text-sm font-medium text-gray-500">{{__('Add new document')}}</h2>
                                        <div class="mt-1 py-3 text-center border rounded-lg border-gray-300">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor" aria-hidden="true">
                                                <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{__('Upload your documents free!!')}}</h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{__('Get started by creating a new document.')}}
                                            </p>
                                            <a href="{{route('user.document.add')}}">
                                                <div class="mt-6">
                                                    <button type="button"
                                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <!-- Heroicon name: solid/plus -->
                                                        <svg class="-ml-1 mr-2 h-5 w-5"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                        {{__('New Document')}}
                                                    </button>
                                                </div>
                                            </a>
                                        </div>

                                        <h2 class="pt-4 text-sm font-medium text-gray-500">{{__('Your documents')}}
                                            ({{__('Total Document')}} : {{count($user[0]->documents)}})</h2>
                                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            @foreach($user[0]->documents as $document)
                                                <div
                                                    class="relative rounded-lg border border-gray-300 mx-2 my-2 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-pink-500">
                                                    <div class="flex-shrink-0">
                                                        <img class="h-30 w-20 border border-gray-50"
                                                             @if(!is_null($document->image))
                                                                 src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse($document->image)->path())}}"
                                                             @else
                                                                 src="{{asset('images/avatar/default.png')}}"
                                                             @endif
                                                             alt="{{$document->title}}">
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <a href="#" class="focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900">
                                                                {{$document->title}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate">
                                                                {{array_search($document->status,\App\Crawler\Enum\Status::asArray())}}
                                                            </p>
                                                            <div class="flex flex-row">
                                                                <p class="text-sm text-gray-500 mt-2">{{$document->view}}
                                                                </p>
                                                                <svg class="relative mt-2.5 ml-1 w-4 h-4" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                </svg>

                                                                <p class="text-sm ml-5 text-gray-500 mt-2">{{$document->download}}
                                                                </p>
                                                                <svg class="relative mt-2.5 ml-1 w-4 h-4" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

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
