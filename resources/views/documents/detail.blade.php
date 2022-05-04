@extends('main')

@section('title', $document->title)

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
    <div class="bg-gray-50">
        <div class="mx-auto py-16 px-4 sm:py-12 sm:px-6 lg:max-w-7xl lg:px-8">
            <!-- Product -->
            <div class="lg:grid lg:grid-rows-1 lg:grid-cols-7 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">
                <!-- Product image -->
                <div class="lg:row-end-1 lg:col-span-3">
                    <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden">
                        <img src="{{asset($document->image ?? 'images/avatar/default.png')}}"
                             alt="{{$document->title}}"
                             class="object-center object-cover">
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                        <a href="{{route('document.detail_download',$document->id)}}"
                           class="button w-full bg-indigo-600 border border-black border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                            Download
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </a>
                        <button type="button"
                                class="w-full bg-indigo-50 border border-transparent border-indigo-500 rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-indigo-700 hover:bg-indigo-100 outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500"
                                data-modal-toggle="readDocument">
                            Read
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="border-t border-gray-200 mt-10 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">Share</h3>
                        <ul role="list" class="flex items-center space-x-6 mt-4">
                            <li>
                                <a href="#"
                                   class="flex items-center justify-center w-6 h-6 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on Facebook</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="flex items-center justify-center w-6 h-6 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on Instagram</span>
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="flex items-center justify-center w-6 h-6 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on Twitter</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path
                                            d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- DOcument details -->
                <div
                    class="max-w-2xl mx-auto mt-14 sm:mt-16 lg:max-w-none lg:mt-0 lg:row-end-2 lg:row-span-2 lg:col-span-4">
                    <div class="flex flex-col-reverse">
                        <div class="mt-4">
                            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">{{$document->title}}</h1>

                            <div class="flex flex-row">
                                <p class="text-sm text-gray-500 mt-2">{{Carbon\Carbon::parse($document->created_at)->format('H:i d-m-Y')}}
                                </p>
                                <p class="text-sm ml-10 text-gray-500 mt-2">{{$document->view}}
                                </p>
                                <svg class="relative mt-2.5 ml-1 w-4 h-4" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>

                                <p class="text-sm ml-5 text-gray-500 mt-2">{{$document->download}}
                                </p>
                                <svg class="relative mt-2.5 ml-1 w-4 h-4" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                            </div>

                            <div class="pt-4">
                                <span class="text-sm">Authors : </span>
                                @foreach($document->users as $author)
                                    <a href="{{route('author.show_detail',$author->id)}}"
                                       class="text-indigo-600">{{$author->name}}</a> ,
                                @endforeach
                            </div>

                        </div>

                        <div>
                            <h3 class="sr-only">Reviews</h3>
                            <div class="flex items-center">
                                @php($count = 0)
                                @for($i=0; $i < $star['total_star']; $i++)
                                    @php($count++)
                                    <svg
                                        class="@if($count <= $star['avg_star']) text-yellow-400 @else text-gray-300 @endif h-5 w-5 flex-shrink-0"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="sr-only">4 out of 5 stars</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-5 pt-5">
                        <h3 class="text-sm font-medium text-gray-900">Page : {{$document->count_page}}</h3>
                        <h3 class="text-sm font-medium text-gray-900">Code : {{$document->code}}</h3>
                        <h3 class="text-sm font-medium text-gray-900">Binding : {{$document->binding}}</h3>
                    </div>

                    <div class="border-t border-gray-200 mt-5 pt-5">
                        <h3 class="text-sm font-medium text-gray-900">Content : </h3>
                        @php($content = App\Libs\DiskPathTools\DiskPathInfo::parse($document->content_file)->read())
                        <p class="text-gray-500 mt-6">{{$content}}</p>
                    </div>

                    <div class="border-t border-gray-200 mt-10 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">Keywords</h3>
                        <div class="mt-4 prose prose-sm text-gray-500">
                            <ul role="list" class="">
                                @foreach($document->keywords as $keyword)
                                    <li>{{$keyword->content}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-5 pt-5">
                        <h3 class="text-sm font-medium text-gray-900">Privacy</h3>
                        <p class="mt-4 text-sm text-gray-500">For personal and professional use. You cannot resell
                            or redistribute these documents in their original or modified state. <a
                                href="{{route('privacy.index')}}"
                                class="font-medium text-indigo-600 hover:text-indigo-500">Read
                                full privacy</a></p>
                    </div>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-white rounded-md">
                <div
                    class="mx-auto mt-8 py-8 px-4 sm:py-8 sm:px-6 max-w-7xl">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Reader Reviews</h2>

                        <div class="mt-3 flex items-center">
                            <div id="viewStar" class="flex">
                                @php($count = 0)
                                @for($i=0; $i < $star['total_star']; $i++)
                                    @php($count++)
                                    <svg
                                        class="@if($count <= $star['avg_star']) text-yellow-400 @else text-gray-300 @endif h-5 w-5 flex-shrink-0"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="ml-2 text-sm text-gray-900">Based on {{count($document->reviews)}} reviews</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Review data</h3>

                            <dl class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">5<span
                                                class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{$star['percent']['one_star']}}%);"
                                                     class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">{{$star['percent']['five_star']}}
                                        %
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">4<span
                                                class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{$star['percent']['four_star']}}%);"
                                                     class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">{{$star['percent']['four_star']}}
                                        %
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">3<span
                                                class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{$star['percent']['three_star']}}%);"
                                                     class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">{{$star['percent']['three_star']}}
                                        %
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">2<span
                                                class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{$star['percent']['two_star']}}%);"
                                                     class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">{{$star['percent']['two_star']}}
                                        %
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">1<span
                                                class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{$star['percent']['one_star']}}%);"
                                                     class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">{{$star['percent']['one_star']}}
                                        %
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="mt-10">
                            <section aria-labelledby="notes-title">
                                <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
                                    <div class="divide-y divide-gray-200">
                                        <div class="px-4 py-5 sm:px-6">
                                            <h2 id="notes-title"
                                                class="text-lg font-medium text-gray-900">{{count($document->reviews)}}
                                                Reviews</h2>
                                        </div>
                                        <div class="px-4 py-6 sm:px-6 overflow-y-auto h-96">
                                            <ul role="list" class="space-y-8">
                                                @foreach($document->reviews as $review)
                                                    <li>
                                                        <div class="flex space-x-3">
                                                            <div class="flex-shrink-0">
                                                                <img class="h-10 w-10 rounded-full"
                                                                     src="{{asset($review->image ?? 'images/avatar/default.jpg')}}"
                                                                     alt="Avatar review">
                                                            </div>
                                                            <div>
                                                                <div class="text-sm">
                                                                    <a class="font-medium text-gray-900">{{$review->name}}</a>
                                                                    <div class="flex items-center mt-1 mb-4">
                                                                        @php($total_star = 0)
                                                                        @for ($i = 1; $i < $star['total_star']; $i++)
                                                                            @php($total_star++)
                                                                            <svg
                                                                                class="@if($total_star <= $review->rating) text-yellow-400 @else text-gray-300 @endif h-5 w-5 flex-shrink-0"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 20 20"
                                                                                fill="currentColor"
                                                                                aria-hidden="true">
                                                                                <path
                                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                            </svg>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1 text-sm text-gray-700">
                                                                    <p>{{$review->review}}</p>
                                                                </div>
                                                                <div class="mt-2 text-sm space-x-2">
                                                                    <span
                                                                        class="text-gray-500 font-medium">{{Carbon\Carbon::parse($document->created_at)->format('H:i M d Y')}}</span>
                                                                    <span
                                                                        class="text-gray-500 font-medium">&middot;</span>
                                                                    <button type="button"
                                                                            class="text-gray-900 font-medium">
                                                                        Reply
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-6 sm:px-6">
                                        <div class="pb-4 text-sm">
                                            <h2 id="notes-title"
                                                class="font-medium text-gray-900">Write a review</h2>
                                        </div>
                                        <div class="flex space-x-3">
                                            <div class="flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{asset($review->image ?? 'images/avatar/default.jpg')}}"
                                                     alt="avatar reviewer">
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                @if (session('success'))
                                                    <div id="alert-3"
                                                         class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200"
                                                         role="alert">
                                                        <svg
                                                            class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                        <div
                                                            class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                                                            {{session('success')}}
                                                        </div>
                                                        <button type="button"
                                                                class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300"
                                                                data-dismiss-target="#alert-3" aria-label="Close">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                      clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endif
                                                <form action="{{route('review.send')}}" method="POST">
                                                    @csrf
                                                    <input type="number" name="document_id" value="{{$document->id}}"
                                                           hidden>
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div class="mb-6">
                                                            <label for="name"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                                                                Name</label>
                                                            <input type="text"
                                                                   @if(auth()->user()) value="{{auth()->user()->name}}"
                                                                   @endif id="name"
                                                                   name="name"
                                                                   class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                                                   placeholder="Your name">
                                                            @if($errors->has('name'))
                                                                <p class="text-red-500 text-sm">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="mb-6">
                                                            <label for="email"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                                                                Email</label>
                                                            <input type="email" name="email" id="email"
                                                                   @if(auth()->user()) value="{{auth()->user()->email}}"
                                                                   @endif
                                                                   class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                                                   placeholder="example@company.com">
                                                            @if($errors->has('email'))
                                                                <p class="text-red-500 text-sm">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="comment"
                                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Review</label>
                                                        <textarea id="review" name="review" rows="3"
                                                                  class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                                                                  placeholder="Write a review..."></textarea>
                                                        @if($errors->has('review'))
                                                            <p class="text-red-500 text-sm">{{ $errors->first('review') }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="mt-3 flex items-center justify-between">
                                                        <a
                                                            class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                                                            <div class="rating"></div>
                                                        </a>
                                                        <button type="submit"
                                                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Send
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @include('documents.read_modal_document')
@endsection

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script>
    <script src="{{asset('js/jquery-star-rating.js')}}"></script>
    <script>
        $('.rating').starRating({
            showInfo: true,
            titles: ["Very Bad", "Poorly", "Medium", "Good", "Excellent!"],
            stars: 5,
        });
    </script>
@endpush
