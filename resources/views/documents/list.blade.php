@extends('main')

@section('title', 'List Document')

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
    <div class="bg-gray-50">
        <div class="max-w-2xl mx-auto pt-16 pb-4 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Found {{$count_documents}} documents in
                total</h2>

            <!-- Filters -->
            <div class="mt-8">
                <section aria-labelledby="filter-heading"
                         class="relative z-10 border-t border-b border-gray-200 grid items-center">
                    <h2 id="filter-heading" class="sr-only">Filters</h2>
                    <div class="relative col-start-1 row-start-1 py-4">
                        <div
                            class="max-w-7xl mx-auto flex space-x-6 divide-x divide-gray-200 text-sm px-4 sm:px-6 lg:px-8">
                            <div class="pt-1.5">
                                <button type="button" class="group text-gray-700 font-medium flex items-center"
                                        aria-controls="disclosure-1" aria-expanded="false">
                                    <!-- Heroicon name: solid/filter -->
                                    <svg class="flex-none w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500"
                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    2 Filters
                                </button>
                            </div>
                            <div class="pl-3">
                            <span
                                class="inline-flex rounded-full border border-gray-200 items-center py-1.5 pl-3 pr-2 text-sm font-medium bg-white text-gray-900">
                              <span>Objects</span>
                              <button type="button"
                                      class="flex-shrink-0 ml-1 h-4 w-4 p-1 rounded-full inline-flex text-gray-400 hover:bg-gray-200 hover:text-gray-500">
                                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                  <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                                </svg>
                              </button>
                            </span>
                                <span
                                    class="inline-flex rounded-full border border-gray-200 items-center py-2 pl-1 pr-2 text-sm font-medium bg-white text-indigo-700">
                              <button type="button"
                                      class="flex-shrink-0 ml-1 h-4 w-4 p-1 rounded-full inline-flex text-indigo-700 hover:bg-gray-200 hover:text-indigo-900">
                                <svg class="h-2 w-2 fill-indigo-700" stroke="currentColor" fill="none"
                                     viewBox="0 0 8 8">
                                  <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                                </svg>
                              </button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden border-t border-gray-200 py-10" id="disclosure-1">
                        <div class="max-w-7xl mx-auto grid grid-cols-2 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
                            <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-2 md:gap-x-6">
                                <fieldset>
                                    <legend class="block font-medium">
                                        Price
                                    </legend>
                                    <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="price-0" name="price[]" value="0" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="price-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                $0 - $25
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="price-1" name="price[]" value="25" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="price-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                $25 - $50
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="price-2" name="price[]" value="50" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="price-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                $50 - $75
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="price-3" name="price[]" value="75" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="price-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                $75+
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend class="block font-medium">
                                        Color
                                    </legend>
                                    <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-0" name="color[]" value="white" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                White
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-1" name="color[]" value="beige" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Beige
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-2" name="color[]" value="blue" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                   checked>
                                            <label for="color-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Blue
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-3" name="color[]" value="brown" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Brown
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-4" name="color[]" value="green" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-4" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Green
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="color-5" name="color[]" value="purple" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-5" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Purple
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-2 md:gap-x-6">
                                <fieldset>
                                    <legend class="block font-medium">
                                        Size
                                    </legend>
                                    <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-0" name="size[]" value="xs" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="size-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                XS
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-1" name="size[]" value="s" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                   checked>
                                            <label for="size-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                S
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-2" name="size[]" value="m" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="size-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                M
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-3" name="size[]" value="l" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="size-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                L
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-4" name="size[]" value="xl" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="size-4" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                XL
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="size-5" name="size[]" value="2xl" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="size-5" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                2XL
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend class="block font-medium">
                                        Category
                                    </legend>
                                    <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="category-0" name="category[]" value="all-new-arrivals"
                                                   type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="category-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                All New Arrivals
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="category-1" name="category[]" value="tees" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="category-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Tees
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="category-2" name="category[]" value="objects" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="category-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Objects
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="category-3" name="category[]" value="sweatshirts" type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="category-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Sweatshirts
                                            </label>
                                        </div>

                                        <div class="flex items-center text-base sm:text-sm">
                                            <input id="category-4" name="category[]" value="pants-and-shorts"
                                                   type="checkbox"
                                                   class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            <label for="category-4" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                Pants &amp; Shorts
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-start-1 row-start-1 py-4">
                        <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="relative inline-block">
                                <div class="flex">
                                    <button type="button"
                                            class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                            id="menu-button" aria-expanded="false" aria-haspopup="true">
                                        Sort
                                        <!-- Heroicon name: solid/chevron-down -->
                                        <svg
                                            class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>

                                <!--
                                  Dropdown menu, show/hide based on menu state.

                                  Entering: "transition ease-out duration-100"
                                    From: "transform opacity-0 scale-95"
                                    To: "transform opacity-100 scale-100"
                                  Leaving: "transition ease-in duration-75"
                                    From: "transform opacity-100 scale-100"
                                    To: "transform opacity-0 scale-95"
                                -->
                                <div
                                    class="hidden origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <!--
                                          Active: "bg-gray-100", Not Active: ""

                                          Selected: "font-medium text-gray-900", Not Selected: "text-gray-500"
                                        -->
                                        <a href="#" class="font-medium text-gray-900 block px-4 py-2 text-sm"
                                           role="menuitem" tabindex="-1" id="menu-item-0">
                                            Most Popular
                                        </a>

                                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem"
                                           tabindex="-1" id="menu-item-1">
                                            Best Rating
                                        </a>

                                        <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem"
                                           tabindex="-1" id="menu-item-2">
                                            Newest
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($documents as $document)
                    <div class="group relative">
                        <div
                            class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="{{asset($document->image)}}"
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
            <div class="pt-10 pb-4">
                {{ $documents->links() }}
            </div>
            <div>
                <select id="per_page" name="per_page"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:border-gray-700 rounded-md font-medium text-sm px-4 py-2 text-center items-center">
                    <option disabled>Books per page :</option>
                    <option value="8" selected>8 Documents</option>
                    <option value="16">16 Documents</option>
                    <option value="32">32 Documents</option>
                    <option value="48">48 Documents</option>
                </select>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
@endpush
