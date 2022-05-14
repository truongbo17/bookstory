@extends('main')

@section('title', 'Author '.$author[0]->name)

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')

    <div class="relative min-h-screen">
        <main class="py-10">
            <!-- Page header -->
            <div
                class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            @if($author[0]->status == \App\Crawler\Enum\UserStatus::ACTIVE)
                                <img class="h-16 w-16 rounded-full"
                                     @if(!is_null($author[0]->image))
                                         src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse($author[0]->image)->path())}}"
                                     @else
                                         src="{{asset('images/avatar/default.jpg')}}"
                                     @endif
                                     alt="">
                            @else
                                <img class="h-16 w-16 rounded-full"
                                     src="{{asset('images/avatar/banned.png')}}"
                                     alt="">
                            @endif
                            <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{$author[0]->name}}</h1>
                        <p class="text-sm font-medium text-gray-500">Joined for <a href="#" class="text-gray-900">BookStory</a>
                            on
                            <time
                                datetime="2020-08-25">{{\Carbon\Carbon::parse($author[0]->created_at)->format('d M Y')}}</time>
                        </p>
                    </div>
                </div>
                @if($author[0]->status == \App\Crawler\Enum\UserStatus::ACTIVE)
                    <div
                        class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                        <button type="button"
                                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-white bg-purple-700 hover:bg-violet-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Follow
                        </button>
                        <button type="button"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Chat
                        </button>
                    </div>
                @endif
            </div>

            <div
                class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-start-1 lg:col-span-2">
                    <!-- Description list-->
                    <section aria-labelledby="applicant-information-title">
                        <div class="bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h2 id="applicant-information-title"
                                    class="text-lg leading-6 font-medium text-gray-900">
                                    {{__('Information')}}
                                </h2>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    {{__('Personal details and documents.')}}
                                </p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    @if($author[0]->status == \App\Crawler\Enum\UserStatus::ACTIVE)
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                {{__('Role')}}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{$author[0]->is_admin ? 'Content' : 'Author'}}
                                            </dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Email address
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{\Illuminate\Support\Str::mask($author[0]->email, '*', 2, 8)}}
                                            </dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                {{__('Total Document')}}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{$author[0]->documents_count}}
                                            </dd>
                                        </div>
                                    @endif
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{__('Status')}}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{array_search($author[0]->status,\App\Crawler\Enum\UserStatus::asArray())}}
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            User privacy
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{__('User privacy, use of technology and cybersecurity are linked to each other. Many previous studies consider online user base religion agnostic; this chapter will try to shed light on the user behaviour factors associated with religious beliefs. Current research did not fully explain the specifics of user behaviour influenced by religion. This chapter will use Islam as the religion in question.')}}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            <div>
                                <a href="#"
                                   class="block bg-gray-50 text-sm font-medium text-gray-500 text-center px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">{{__('Report Author')}}</a>
                            </div>
                        </div>
                    </section>
                </div>

                <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                        <h2 id="timeline-title" class="text-lg font-medium text-gray-900">{{__('Documents')}}
                            ({{$author[0]->documents_count}})</h2>

                        <!-- Activity Feed -->
                        <div class="mt-6 flow-root">
                            <div class="mt-1 grid grid-cols-1">
                                @foreach($author[0]->documents as $document)
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
                                            <a href="{{route('document.show_detail',$document->slug)}}"
                                               class="focus:outline-none">
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
                        <div class="mt-6 flex flex-col justify-stretch">
                            <div class="grid grid-cols-2 gat-4">
                                <button type="button" onclick="backPage()"
                                        class="mr-8 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="mr-1 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" onclick="nextPage()"
                                        class="ml-6 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Next
                                    <svg class="ml-1 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

@endsection

@push('javascript')
    <script>
        let url = "{{ url()->full() }}";
        url = unEntity(url);
        currentPage = parseInt(getDocumentPageFromUrl(url));
        if (currentPage !== null && currentPage % 5 !== 0) currentPage = 0;

        function backPage() {
            if (currentPage === null || currentPage < 1) return;
            currentPage = currentPage - 5;
            url = updateQueryStringParameter(url, 'document_page', currentPage);
            window.location = url;
        }

        function nextPage() {
            currentPage = currentPage + 5;
            url = updateQueryStringParameter(url, 'document_page', currentPage);
            window.location = url;
        }

        function getDocumentPageFromUrl(url) {
            return new URL(url).searchParams.get('document_page');
        }

        //Replace &amp url
        function unEntity(str) {
            return str.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
        }

        //Update end set param url
        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }

        //End Update end set param url
    </script>
@endpush
