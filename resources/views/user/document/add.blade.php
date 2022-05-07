@extends('main')

@section('title', 'Add Document')

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
                        <h1 class="text-2xl font-semibold text-gray-900">Dashboard - Add Document</h1>
                    </div>
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            <div class="border-4 border-dashed border-gray-200 rounded-lg h-full">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 pt-5">
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
                                                <div
                                                    class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
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
                                    </div>
                                    <form action="{{route('user.document.store')}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                <p class="text-gray-600 text-sm font-semibold">Note : Field <span
                                                        class="text-red-700 text-sm">(*)</span> is required</p>
                                                <p class="text-gray-600 text-sm font-semibold"> <span
                                                        class="text-red-700 text-sm"> Currently can only upload in PDF format </span>
                                                </p>
                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        Title <span class="text-red-700 text-sm">*</span>
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" value="{{ old('title') }}" name="title"
                                                               id="title"
                                                               autocomplete="title" placeholder="title of document"
                                                               class="@error('title') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>

                                                <div class="gap-6">
                                                    <div class="col-span-3 sm:col-span-2">
                                                        <label for="company-website"
                                                               class="block text-sm font-medium text-gray-700">
                                                            Slug
                                                        </label>
                                                        <div class="mt-1 flex rounded-md shadow-sm">
                                                              <span
                                                                  class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                                {{request()->getHost()}}
                                                              </span>
                                                            <input type="text" name="slug"
                                                                   id="slug" value="{{ old('slug') }}"
                                                                   class="@error('slug') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                   placeholder="huong-dan-cham-soc-nguoi-mac-covid-19">
                                                        </div>
                                                        <p class="mt-2 text-sm text-gray-500">
                                                            If the slug is blank, it will be automatically generated by
                                                            title.
                                                        </p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        Description <span class="text-red-700 text-sm">*</span>
                                                    </label>
                                                    <div class="mt-1">
                                                        <textarea id="content" name="content" rows="4"
                                                                  class="@error('content') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                                  placeholder="content of document">{{ old('content') }}</textarea>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        Keyword <span
                                                            class="text-red-700 text-sm">(separated by commas)</span>
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" value="{{ old('keyword') }}" name="keyword"
                                                               id="keyword"
                                                               autocomplete="keyword" placeholder="keyword of document"
                                                               class="@error('keyword') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-2">
                                                    <div>
                                                        <label for="about"
                                                               class="block text-sm font-medium text-gray-700">
                                                            Code
                                                        </label>
                                                        <div class="mt-1">
                                                            <input type="number" name="code" value="{{ old('code') }}"
                                                                   id="code"
                                                                   autocomplete="code" placeholder="code of document"
                                                                   class="@error('code') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>
                                                    <div class="ml-5">
                                                        <label for="about"
                                                               class="block text-sm font-medium text-gray-700">
                                                            Page<span class="text-red-700 text-sm">*</span>
                                                        </label>
                                                        <div class="mt-1">
                                                            <input type="number" name="page" id="page"
                                                                   value="{{ old('page') }}"
                                                                   autocomplete="page" placeholder="count of document"
                                                                   class="@error('page') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="">
                                                        <label class="block text-sm font-medium text-gray-700">
                                                            Image <span class="mt-2 text-sm text-red-700">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="mt-1 flex items-center">
                                                        <span
                                                            class="inline-block h-30 w-20 overflow-hidden bg-gray-100">
                                                         <img
                                                             src="{{asset('images/avatar/default.png')}}"
                                                             id="image"/>
                                                        </span>
                                                            <input
                                                                class="text-sm ml-1 @error('image') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror"
                                                                accept="image/*" name="image"
                                                                type="file"
                                                                id="files"/>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        document.getElementById('files').onchange = function () {
                                                            var src = URL.createObjectURL(this.files[0])
                                                            document.getElementById('image').src = src
                                                        }
                                                    </script>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">
                                                        Document file <span class="text-red-700 text-sm">*</span>
                                                    </label>
                                                    <label for="file_upload">
                                                        <div
                                                            class="@error('file_upload') border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500 @enderror mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                            <div class="space-y-1 text-center">
                                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                                     stroke="currentColor"
                                                                     viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                </svg>
                                                                <div class="flex text-sm text-gray-600">
                                                                    <label for="file_upload"
                                                                           class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                        <span>Upload a document</span>
                                                                        <input id="file_upload" name="file_upload"
                                                                               type="file" accept="application/pdf"
                                                                               class="sr-only">
                                                                    </label>
                                                                    <p class="pl-1">or drag and drop</p>
                                                                </div>
                                                                <p class="text-xs text-gray-500">
                                                                    PDF up to 10MB
                                                                </p>
                                                                <p class="text-sm text-bold text-indigo-700"
                                                                   id="result"></p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div
                                                class="py-4 grid grid-cols-2 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200">
                                                <button type="button"
                                                        onclick="location.href='{{route('user.document.list')}}'"
                                                        class="mx-4 col-span-1 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Back
                                                </button>
                                                <button type="submit"
                                                        class="mx-4 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
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
    <script>
        $('#file_upload').change(function () {
            var filename = $(this)[0].files[0].name;
            $('#result').text("Your file upload : "+filename);
        });
    </script>
@endpush
