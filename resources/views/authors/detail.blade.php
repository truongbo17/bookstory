@extends('main')

@section('title', 'Author '.$author->name)

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
                            @if($author->status == \App\Crawler\Enum\UserStatus::ACTIVE)
                                <img class="h-16 w-16 rounded-full"
                                     src="{{asset($author->image ?? 'images/avatar/default.jpg')}}"
                                     alt="">
                            @else
                                <img class="h-16 w-16 rounded-full"
                                     src="{{asset($author->image ?? 'images/avatar/banned.png')}}"
                                     alt="">
                            @endif
                            <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{$author->name}}</h1>
                        <p class="text-sm font-medium text-gray-500">Joined for <a href="#" class="text-gray-900">BookStory</a>
                            on
                            <time
                                datetime="2020-08-25">{{\Carbon\Carbon::parse($author->created_at)->format('d M Y')}}</time>
                        </p>
                    </div>
                </div>
                @if($author->status == \App\Crawler\Enum\UserStatus::ACTIVE)
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
                                    Information
                                </h2>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Personal details and documents.
                                </p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    @if($author->status == \App\Crawler\Enum\UserStatus::ACTIVE)
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Role
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{$author->is_admin ? 'Admin' : 'Role'}}
                                            </dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Email address
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{\Illuminate\Support\Str::mask($author->email, '*', 3, 5)}}
                                            </dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Total Document
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{count($author->documents)}}
                                            </dd>
                                        </div>
                                    @endif
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Status
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{array_search($author->status,\App\Crawler\Enum\UserStatus::asArray())}}
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            User privacy
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            User privacy, use of technology and cybersecurity are linked to each other.
                                            Many previous studies consider online user base religion agnostic; this
                                            chapter will try to shed light on the user behaviour factors associated with
                                            religious beliefs. Current research did not fully explain the specifics of
                                            user behaviour influenced by religion. This chapter will use Islam as the
                                            religion in question.
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            <div>
                                <a href="#"
                                   class="block bg-gray-50 text-sm font-medium text-gray-500 text-center px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">Read
                                    full application</a>
                            </div>
                        </div>
                    </section>
                </div>

                <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                        <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Documents</h2>

                        <!-- Activity Feed -->
                        <div class="mt-6 flow-root">
                            <ul role="list" class="-mb-8">
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                              aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                      <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/user -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"/>
                        </svg>
                      </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Applied to <a href="#"
                                                                                                   class="font-medium text-gray-900">Front
                                                            End Developer</a></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="2020-09-20">Sep 20</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                              aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                      <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/thumb-up -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                          <path
                              d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                        </svg>
                      </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Advanced to phone screening by <a
                                                            href="#" class="font-medium text-gray-900">Bethany Blake</a>
                                                    </p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="2020-09-22">Sep 22</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                              aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                      <span
                          class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/check -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"/>
                        </svg>
                      </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Completed phone screening with <a
                                                            href="#" class="font-medium text-gray-900">Martha
                                                            Gardner</a></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="2020-09-28">Sep 28</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                              aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                      <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/thumb-up -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                          <path
                              d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                        </svg>
                      </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Advanced to interview by <a
                                                            href="#" class="font-medium text-gray-900">Bethany Blake</a>
                                                    </p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="2020-09-30">Sep 30</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="relative pb-8">
                                        <div class="relative flex space-x-3">
                                            <div>
                      <span
                          class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/check -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"/>
                        </svg>
                      </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Completed interview with <a
                                                            href="#" class="font-medium text-gray-900">Katherine
                                                            Snyder</a></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="2020-10-04">Oct 4</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-6 flex flex-col justify-stretch">
                            <div class="grid grid-cols-2 gat-4">
                                <button type="button"
                                        class="mr-8 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="mr-1 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                    </svg>
                                    Back
                                </button>
                                <button type="button"
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
@endpush
