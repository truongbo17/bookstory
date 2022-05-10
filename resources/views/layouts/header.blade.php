<div class="bg-white">
    <div class="fixed inset-0 flex z-40 lg:hidden hidden " role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>
        <div class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto">
            <div class="px-4 pt-5 pb-2 flex">
                <button type="button"
                        class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400">
                    <span class="sr-only">Close menu</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>


            <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                <div class="flow-root">
                    <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Company</a>
                </div>

                <div class="flow-root">
                    <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Stores</a>
                </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                <div class="flow-root">
                    <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Sign in</a>
                </div>
                <div class="flow-root">
                    <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Create account</a>
                </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4">
                <a href="#" class="-m-2 p-2 flex items-center">
                    <img src="{{ asset('images/logo/logo-header.png') }}" alt=""
                         class="w-5 h-auto block flex-shrink-0">
                    <span class="ml-3 block text-base font-medium text-gray-900"> CAD </span>
                    <span class="sr-only">, change currency</span>
                </a>
            </div>
        </div>
    </div>

    <header class="relative bg-white">


        <nav aria-label="Top" class=" relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="dropdownMenuSearch"
                 style="top:100%; z-index: 100; "
                 class="hidden transition ease-in-out delay-150 absolute mx-4 mt-2 left-0 right-0 z-10 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                <div class="relative mx-auto text-indigo-700">
                    <form method="GET" action="{{route('search')}}">
                        <button type="submit" class="absolute right-0 mx-4 mr-2"
                                style="z-index: 100; top: 50%; transform: translateY(-50%)">
                            <svg class="w-6 h-6 pl-2 text-indigo-900"
                                 style="box-sizing: content-box;border-left:1px solid #dcdcdc;"
                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                        <input
                            class="w-full py-6 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                            type="search" name="q" placeholder="{{__('Search')}}">
                    </form>
                </div>
            </div>

            <div class="border-b border-gray-200">
                <div class="h-16 flex items-center">
                    <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                    <button type="button" class="bg-white p-2 rounded-md text-gray-400 lg:hidden">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Logo -->
                    <div class="ml-4 flex lg:ml-0">
                        <a href="{{route('home.index')}}">
                            <span class="sr-only">Workflow</span>
                            <img class="h-8 w-auto" src="{{ asset('images/logo/logo-header.png') }}" alt="">
                        </a>
                    </div>

                    <!-- Flyout menus -->
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="h-full flex space-x-8">
                            <a href="{{route('document.list_index')}}"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{__('Documents')}}</a>

                            <a href="{{route('author.list_index')}}"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{__('Authors')}}</a>

                            <a href="#"
                               class="flex items-center rounded-full text-pink-700 text-sm font-medium hover:text-red-800">
                                {{__('News')}}
                            </a>

                            <a href="{{route('privacy.index')}}"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{__('Privacy')}}</a>

                            <a href="{{route('contact.create')}}"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{__('Contact')}}</a>
                        </div>
                    </div>

                    <div class="ml-auto flex items-center">
                        <!-- Search -->
                        <div class="">
                            <div class="flex lg:ml-6" id="dropdownButtonSearch">
                                <a href="#" class="p-2 text-gray-400 hover:text-gray-700">
                                    <span class="sr-only">Search</span>
                                    <!-- Heroicon name: outline/search -->
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </a>
                            </div>

                        </div>

                        <div class="ml-4 flex items-center">
                            @if(!auth()->user())
                                <div class="relative">
                                    <div class="flex lg:ml-6">
                                        <a href="{{route('login')}}" class="p-2 text-gray-400 hover:text-gray-700">
                                            <span class="sr-only">Auth</span>
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <a href="{{route('login')}}">
                                    <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                         @if(!is_null(auth()->user()->image))
                                             src="{{asset(config('crawl.public_link_storage').\App\Libs\DiskPathTools\DiskPathInfo::parse(auth()->user()->image)->path())}}"
                                         @else
                                             src="{{asset('images/avatar/default.jpg')}}"
                                         @endif
                                         alt="avatar">
                                </a>
                            @endif

                            <div class="hidden lg:ml-8 lg:flex relative" style="z-index:100000">
                                <button id="dropdownButton"
                                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
                                        type="button">
                                    @if(Session::get('website_language') === null)
                                        @php($language = config('crawl.lang')[config('app.locale')])
                                        <img src="{{$language['img']}}" alt="{{$language['name']}}"
                                             class="w-5 h-auto block flex-shrink-0">
                                        <span class="ml-2 text-sm font-medium">{{$language['name']}}</span>
                                    @else
                                        @foreach(config('crawl.lang') as $key_language => $language)
                                            @if($key_language === Session::get('website_language'))
                                                <img src="{{$language['img']}}" alt="{{$language['name']}}"
                                                     class="w-5 h-auto block flex-shrink-0">
                                                <span class="ml-2 text-sm font-medium">{{$language['name']}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownMenu"
                                     style="top: calc(100% + 10px)"
                                     class="hidden absolute z-10 w-full bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownBottomButton">
                                        @php($language_session = Session::get('website_language') ?? config('app.locale'))
                                        @foreach(config('crawl.lang') as $key_language => $language)
                                            @if($key_language !== $language_session)
                                                <li>
                                                    <a href="{!! route($language['href']['route'],$language['href']['param']) !!}"
                                                       class="flex text-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        <img src="{{$language['img']}}" alt="{{$language['name']}}"
                                                             class="w-5 h-auto block flex-shrink-0">
                                                        <span
                                                            class="ml-2 text-sm font-medium">{{$language['name']}}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>

<script>
    //Language
    const buttonDropMenu = document.getElementById('dropdownButton');
    const menuLanguageDrop = document.getElementById('dropdownMenu');

    //Search
    const dropdownButtonSearch = document.getElementById('dropdownButtonSearch');
    const dropdownMenuSearch = document.getElementById('dropdownMenuSearch');

    buttonDropMenu.addEventListener('click', function () {
        menuLanguageDrop.classList.toggle('hidden');
    });

    dropdownButtonSearch.addEventListener('click', function () {
        dropdownMenuSearch.classList.toggle('hidden');
    });
</script>
