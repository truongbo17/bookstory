<div class="bg-gray-50">
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{__('Popular Documents')}}</h2>

        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach($documents as $document)
                <div class="group relative">
                    <div
                        class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img @if(!is_null($document->image) && mb_strlen($document->image) > 5)
                                 src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse($document->image)->path())}}"
                             @else
                                 src="{{asset('images/avatar/default.png')}}"
                             @endif
                             alt="{{$document->title}}"
                             class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-900">
                                <a href="{{route('document.show_detail', $document->slug)}}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{Str::of($document->title)->limit(100)}}
                                </a>
                            </h3>
                            @php($content = App\Libs\DiskPathTools\DiskPathInfo::parse($document->content_file)->read())
                            <p class="mt-1 text-sm text-gray-500">{{Str::of($content)->limit(80)}}</p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <p class="text-sm font-medium text-gray-900">{{$document->view}}
                                </p>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <div class="flex flex-row">
                                <p class="text-sm font-medium text-gray-900">{{$document->download}}
                                </p>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section class="text-gray-900 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="text-center mb-5">
                <h3 class="text-xl font-extrabold tracking-tight sm:text-4xl">{{__('Top Keyword')}}</h3>
            </div>
            <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
                @foreach($top_keyword as $keyword)
                    <div class="p-2 sm:w-1/2 w-full">
                        <a href="{{route('related.show_detail',$keyword->slug)}}">
                            <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                <svg class="text-indigo-600 w-6 h-6 flex-shrink-0 mr-4" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="title-font font-medium">{{$keyword->title}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto mb-8 px-4 text-center sm:px-6 lg:px-8 lg:py-8">
        <div class="space-y-8 sm:space-y-12">
            <div class="space-y-5 sm:mx-auto sm:max-w-xl sm:space-y-4 lg:max-w-5xl">
                <h3 class="text-xl font-extrabold tracking-tight sm:text-4xl">{{__('Authors')}}</h3>
                <p class="text-xl text-gray-500">{{__('Most active contributors')}}</p>
            </div>
            <ul role="list"
                class="mx-auto grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 md:gap-x-6 lg:max-w-5xl lg:gap-x-8 lg:gap-y-12 xl:grid-cols-4">
                @foreach($authors as $author)
                    <li>
                        <a href="{{route('author.show_detail', $author->id)}}">
                            <div class="space-y-4">
                                <img class="mx-auto h-20 w-20 rounded-full lg:w-24 lg:h-24"
                                     @if(!is_null($author->image))
                                         src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse($author->image)->path())}}"
                                     @else
                                         src="{{asset('images/avatar/default.jpg')}}"
                                     @endif
                                     alt="{{$author->name}}">
                                <div class="space-y-2">
                                    <div class="text-xs font-medium lg:text-sm">
                                        <h3>{{$author->name}}</h3>
                                        <p class="text-indigo-600">{{$author->documents_count}} {{__('Documents')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Analytic -->

