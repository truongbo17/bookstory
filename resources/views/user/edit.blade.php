@extends('main')

@section('title', 'Edit Profile')

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
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        {{--        <div class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">--}}
        {{--            <!----}}
        {{--              Off-canvas menu overlay, show/hide based on off-canvas menu state.--}}

        {{--              Entering: "transition-opacity ease-linear duration-300"--}}
        {{--                From: "opacity-0"--}}
        {{--                To: "opacity-100"--}}
        {{--              Leaving: "transition-opacity ease-linear duration-300"--}}
        {{--                From: "opacity-100"--}}
        {{--                To: "opacity-0"--}}
        {{--            -->--}}
        {{--            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>--}}

        {{--            <!----}}
        {{--              Off-canvas menu, show/hide based on off-canvas menu state.--}}

        {{--              Entering: "transition ease-in-out duration-300 transform"--}}
        {{--                From: "-translate-x-full"--}}
        {{--                To: "translate-x-0"--}}
        {{--              Leaving: "transition ease-in-out duration-300 transform"--}}
        {{--                From: "translate-x-0"--}}
        {{--                To: "-translate-x-full"--}}
        {{--            -->--}}
        {{--            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-indigo-700">--}}
        {{--                <!----}}
        {{--                  Close button, show/hide based on off-canvas menu state.--}}

        {{--                  Entering: "ease-in-out duration-300"--}}
        {{--                    From: "opacity-0"--}}
        {{--                    To: "opacity-100"--}}
        {{--                  Leaving: "ease-in-out duration-300"--}}
        {{--                    From: "opacity-100"--}}
        {{--                    To: "opacity-0"--}}
        {{--                -->--}}
        {{--                <div class="absolute top-0 right-0 -mr-12 pt-2">--}}
        {{--                    <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">--}}
        {{--                        <span class="sr-only">Close sidebar</span>--}}
        {{--                        <!-- Heroicon name: outline/x -->--}}
        {{--                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
        {{--                        </svg>--}}
        {{--                    </button>--}}
        {{--                </div>--}}

        {{--                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">--}}
        {{--                    <div class="flex-shrink-0 flex items-center px-4">--}}
        {{--                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">--}}
        {{--                    </div>--}}
        {{--                    <nav class="mt-5 px-2 space-y-1">--}}
        {{--                        <!-- Current: "bg-indigo-800 text-white", Default: "text-white hover:bg-indigo-600 hover:bg-opacity-75" -->--}}
        {{--                        <a href="#" class="bg-indigo-800 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/home -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />--}}
        {{--                            </svg>--}}
        {{--                            Dashboard--}}
        {{--                        </a>--}}

        {{--                        <a href="#" class="text-white hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/users -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />--}}
        {{--                            </svg>--}}
        {{--                            Team--}}
        {{--                        </a>--}}

        {{--                        <a href="#" class="text-white hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/folder -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />--}}
        {{--                            </svg>--}}
        {{--                            Projects--}}
        {{--                        </a>--}}

        {{--                        <a href="#" class="text-white hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/calendar -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
        {{--                            </svg>--}}
        {{--                            Calendar--}}
        {{--                        </a>--}}

        {{--                        <a href="#" class="text-white hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/inbox -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />--}}
        {{--                            </svg>--}}
        {{--                            Documents--}}
        {{--                        </a>--}}

        {{--                        <a href="#" class="text-white hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
        {{--                            <!-- Heroicon name: outline/chart-bar -->--}}
        {{--                            <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />--}}
        {{--                            </svg>--}}
        {{--                            Reports--}}
        {{--                        </a>--}}
        {{--                    </nav>--}}
        {{--                </div>--}}
        {{--                <div class="flex-shrink-0 flex border-t border-indigo-800 p-4">--}}
        {{--                    <a href="#" class="flex-shrink-0 group block">--}}
        {{--                        <div class="flex items-center">--}}
        {{--                            <div>--}}
        {{--                                <img class="inline-block h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">--}}
        {{--                            </div>--}}
        {{--                            <div class="ml-3">--}}
        {{--                                <p class="text-base font-medium text-white">--}}
        {{--                                    Tom Cook--}}
        {{--                                </p>--}}
        {{--                                <p class="text-sm font-medium text-indigo-200 group-hover:text-white">--}}
        {{--                                    View profile--}}
        {{--                                </p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <div class="flex-shrink-0 w-14" aria-hidden="true">--}}
        {{--                <!-- Force sidebar to shrink to fit close icon -->--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Static sidebar for desktop -->
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
                        <h1 class="text-2xl font-semibold text-gray-900">Dashboard - Edit Profile</h1>
                    </div>
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            <div class="border-4 border-dashed border-gray-200 rounded-lg h-full">
                                <div class="px-4 py-4 bg-white shadow overflow-hidden sm:rounded-lg">
                                    @if (session('status'))
                                        <div id="alert-3"
                                             class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200"
                                             role="alert">
                                            <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                                                {{session('status')}}
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
                                    @foreach ($errors->all() as $key => $error)
                                        <div id="alert-{{$key}}"
                                             class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200"
                                             role="alert">
                                            <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800"
                                                 fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                                                {{$error}}
                                            </div>
                                            <button type="button"
                                                    class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                                                    data-dismiss-target="#alert-{{$key}}" aria-label="Close">
                                                <span class="sr-only">Close</span>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                    <form class="space-y-8 divide-y divide-gray-200"
                                          action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                            <div>
                                                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            Personal Information
                                                        </h3>
                                                    </div>
                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                                        <label for="email"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            Fullname
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input value="{{auth()->user()->name}}" id="name"
                                                                   name="name" type="text" autocomplete="name"
                                                                   class=" @error('name') border-red-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="email"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            Email address
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input value="{{auth()->user()->email}}" id="email"
                                                                   name="email" type="email"
                                                                   autocomplete="email"
                                                                   class=" @error('email') border-red-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="photo"
                                                               class="block text-sm font-medium text-gray-700">
                                                            Photo
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <div class="flex items-center">
                                                              <span
                                                                  class="h-14 w-14 rounded-full overflow-hidden bg-gray-100">
                                                                    <img
                                                                        src="{{asset(auth()->user()->image ?? 'images/avatar/default.jpg')}}"
                                                                        id="image"/>
                                                              </span>
                                                                <button type="button"
                                                                        class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                    <input accept="image/*" name="image" type="file"
                                                                           id="files"/>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        document.getElementById('files').onchange = function () {
                                                            var src = URL.createObjectURL(this.files[0])
                                                            document.getElementById('image').src = src
                                                        }
                                                    </script>

                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            Password
                                                        </h3>
                                                    </div>
                                                    <div
                                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="password"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            Old password
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input placeholder="••••••••" id="old_password"
                                                                   name="old_password" type="password"
                                                                   autocomplete="new-password"
                                                                   class=" @error('old_password') border-red-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="password"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            New password
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input placeholder="••••••••" id="password"
                                                                   name="password" type="password"
                                                                   autocomplete="password"
                                                                   class=" @error('password') border-red-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="confirm_password"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            Confirm password
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input placeholder="••••••••" id="confirm_password"
                                                                   name="confirm_password" type="password"
                                                                   autocomplete="new-password"
                                                                   class=" @error('confirm_password') border-red-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="grid grid-cols-2 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-8">
                                                        <button type="button"
                                                                onclick="location.href='{{route('user.profile')}}'"
                                                                class="mx-4 col-span-1 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Back
                                                        </button>
                                                        <button type="submit"
                                                                class="mx-4 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
