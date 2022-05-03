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
                                        onclick="filterToggle()"
                                        aria-expanded="false">
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
                                    class="inline-flex rounded-full border border-gray-200 items-center py-2 pl-1 pr-2 text-sm font-medium bg-white text-indigo-700">
                              <button type="button" id="clearFilter"
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
                    <div class="border-t border-gray-200 py-10" style="display: none;" id="filter" tabindex="-1"
                         aria-hidden="true">
                        <form id="filterForm">
                            <div
                                class="max-w-7xl mx-auto grid grid-cols-2 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
                                <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-2 md:gap-x-6">
                                    <fieldset>
                                        <legend class="block font-medium">
                                            Count Page
                                        </legend>
                                        <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                            <div class="flex items-center text-base sm:text-sm">
                                                <input id="check-1" name="count_page" value="1" type="checkbox"
                                                       class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                       onclick="selectOnlyThis(this.id)">
                                                <label for="price-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                    0 - 100
                                                </label>
                                            </div>
                                            <div class="flex items-center text-base sm:text-sm">
                                                <input id="check-2" name="count_page" value="2" type="checkbox"
                                                       class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                       onclick="selectOnlyThis(this.id)">
                                                <label for="price-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                    100 - 200
                                                </label>
                                            </div>
                                            <div class="flex items-center text-base sm:text-sm">
                                                <input id="check-3" name="count_page" value="3" type="checkbox"
                                                       class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                       onclick="selectOnlyThis(this.id)">
                                                <label for="price-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                    200 - 500
                                                </label>
                                            </div>
                                            <div class="flex items-center text-base sm:text-sm">
                                                <input id="check-4" name="count_page" value="4" type="checkbox"
                                                       class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                       onclick="selectOnlyThis(this.id)">
                                                <label for="price-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                                    > 500
                                                </label>
                                            </div>
                                        </div>

                                    </fieldset>
                                    <fieldset>
                                        <legend class="block font-medium">
                                            Author
                                        </legend>
                                        <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                            <div class="flex items-center text-base sm:text-sm">
                                                <label for="size-0" class="mr-3 text-gray-600">
                                                    Name:
                                                </label>
                                                <input id="author" name="author" type="text"
                                                       class="border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <button type="submit"
                                    class="flex justify-center ml-8 mt-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter Now
                            </button>
                        </form>
                    </div>
                    <div class="col-start-1 row-start-1 py-4">
                        <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="relative inline-block">
                                <div class="flex">
                                    <button onclick="sortToggle()" type="button"
                                            class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                            id="menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span id="sortTitle"></span>
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
                                <div
                                    style="display: none" id="sort"
                                    class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <a onclick="sortValue('az')"
                                           class="font-medium cursor-pointer text-gray-600 @if(app('request')->input('sort')== 'az') text-indigo-600 @endif block px-4 py-2 text-sm hover:text-gray-900"
                                           role="menuitem" tabindex="-1" id="menu-item-0">
                                            Title Ascending
                                        </a>

                                        <a onclick="sortValue('za')"
                                           class="font-medium cursor-pointer text-gray-600 @if(app('request')->input('sort')== 'za') text-indigo-600 @endif block px-4 py-2 text-sm hover:text-gray-900"
                                           role="menuitem"
                                           tabindex="-1" id="menu-item-1">
                                            Title Descending
                                        </a>

                                        <a onclick="sortValue('daz')"
                                           class="font-medium cursor-pointer text-gray-600 @if(app('request')->input('sort')== 'daz') text-indigo-600 @endif block px-4 py-2 text-sm hover:text-gray-900"
                                           role="menuitem"
                                           tabindex="-1" id="menu-item-1">
                                            Date Ascending
                                        </a>

                                        <a onclick="sortValue('dza')"
                                           class="font-medium cursor-pointer text-gray-600 @if(app('request')->input('sort')== 'dza') text-indigo-600 @endif block px-4 py-2 text-sm hover:text-gray-900"
                                           role="menuitem"
                                           tabindex="-1" id="menu-item-1">
                                            Date Descending
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
                            <img src="{{asset($document->image ?? 'images/avatar/default.png')}}"
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
                <form>
                    <select id="per_page" name="per_page"
                            class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:border-gray-700 rounded-md font-medium text-sm px-4 py-2 text-center items-center">
                        <option disabled>Books per page :</option>
                        <option value="12" @if(!app('request')->input('perpage')) selected @endif>12 Documents</option>
                        <option value="16" @if(app('request')->input('perpage')== 16) selected @endif>16 Documents
                        </option>
                        <option value="32" @if(app('request')->input('perpage')== 32) selected @endif>32 Documents
                        </option>
                        <option value="48" @if(app('request')->input('perpage')== 48) selected @endif>48 Documents
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script>
        let url = "{{ url()->full() }}";
        url = unEntity(url);
        const rootUrl = '{{url()->current()}}';
        newUrl = new URL(url);

        //Toggle modal filter
        const filter = document.getElementById('filter');
        const sort = document.getElementById('sort');

        function filterToggle() {
            if (filter.style.display === "none") {
                filter.style.display = "block";
            } else {
                filter.style.display = "none";
            }
        }

        function sortToggle() {
            if (sort.style.display === "none") {
                sort.style.display = "block";
            } else {
                sort.style.display = "none";
            }
        }

        //End toggle modal filter

        //Perpage
        document.getElementById('per_page').onchange = function () {
            let perpage = this.value;
            url = updateQueryStringParameter(url, "perpage", perpage);
            url = unEntity(url);
            url = decodeURI(url);
            window.location = url;
        };
        //End Perpage

        //Sort
        function sortValue(sortValue) {
            url = updateQueryStringParameter(url, "sort", sortValue);
            url = unEntity(url);
            url = decodeURI(url);
            window.location = url;
        }

        var sortTitle = document.getElementById('sortTitle');
        var requestSort = '{{app('request')->input('sort')}}';
        if (requestSort === 'az') {
            sortTitle.innerText = 'Title Ascending'
        } else if (requestSort === 'za') {
            sortTitle.innerText = 'Title Descending'
        } else if (requestSort === 'daz') {
            sortTitle.innerText = 'Date Ascending'
        } else if (requestSort === 'dza') {
            sortTitle.innerText = 'Date Descending'
        } else {
            sortTitle.innerText = 'Sort';
        }
        //End sort

        //Select one CheckBox
        function selectOnlyThis(id) {
            for (var i = 1; i <= 4; i++) {
                document.getElementById("check-" + i).checked = false;
            }
            document.getElementById(id).checked = true;
        }

        //End Select one CheckBox

        //Clear Filter
        document.getElementById('clearFilter').onclick = function () {
            window.location = rootUrl;
        };
        //End Clear Filter

        //Submit form filter
        var filterForm = document.getElementById('filterForm');
        filterForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var author = filterForm.querySelector('input[name="author"]').value;
            var count_page = Array.from(filterForm.querySelectorAll('input[type=checkbox]:checked'))
                .map(item => item.value)
                .join(',');

            if (author.length > 0 && count_page.length > 0) {
                newUrl.searchParams.set('users[name]', author);
                newUrl.searchParams.set('count_page', count_page);

                url = rootUrl + newUrl.search;
            } else if (author.length > 0 && count_page.length < 1) {
                url = updateQueryStringParameter(url, 'users[name]', author);
            } else if (author.length < 1 && count_page.length > 0) {
                url = updateQueryStringParameter(url, 'count_page', count_page);
            }
            url = unEntity(url);
            url = decodeURI(url);
            window.location = url;
        });
        //End submit form filter

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

        //Replace &amp url
        function unEntity(str) {
            return str.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
        }

        //End replace

        //Get author and count_page
        const authorValue = newUrl.searchParams.get("users[name]");
        const count_pageValue = newUrl.searchParams.get("count_page");

        document.getElementById('author').value = authorValue;

        let elements = document.getElementsByName("count_page");
        for (let i = 0; i < elements.length; i++) {
            if (elements[i].value === count_pageValue) {
                elements[i].checked = true;
            }
        }
        //End get author and count_page
    </script>
@endpush
