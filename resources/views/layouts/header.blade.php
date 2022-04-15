<div class="bg-white">
    <div class="fixed inset-0 flex z-40 lg:hidden hidden    " role="dialog" aria-modal="true">
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
        <nav aria-label="Top" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <a href="#">
                            <span class="sr-only">Workflow</span>
                            <img class="h-8 w-auto" src="{{ asset('images/logo/logo-header.png') }}" alt="">
                        </a>
                    </div>

                    <!-- Flyout menus -->
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="h-full flex space-x-8">
                            <div class="flex">
                                <div class="relative flex">
                                    <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                    <button type="button"
                                            class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px"
                                            aria-expanded="false">Documents
                                    </button>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="relative flex">
                                    <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                    <button type="button"
                                            class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px"
                                            aria-expanded="false">Author
                                    </button>
                                </div>
                            </div>

                            <a href="#"
                               class="flex items-center rounded-full text-pink-700 text-sm font-medium hover:text-red-800">
                                News
                            </a>

                            <a href="#"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Privacy</a>

                            <a href="#"
                               class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Contact</a>
                        </div>
                    </div>

                    <div class="ml-auto flex items-center">
                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                            <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                            <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                account</a>
                        </div>

                        <div class="hidden lg:ml-8 lg:flex relative">
                            <button id="dropdownButton"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                <img src="{{ asset('images/flag/english.webp') }}" alt=""
                                     class="w-5 h-auto block flex-shrink-0">
                                <span class="ml-3 block text-sm font-medium"> ENG </span>
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownMenu"
                                 class="hidden absolute top-6 z-10 w-20 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownBottomButton">
                                    <li>
                                        <a href="#"
                                           class="flex text-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <img src="{{ asset('images/flag/vietnam.png') }}" alt=""
                                                 class="w-5 h-auto block flex-shrink-0">
                                            <span class="ml-2 text-sm font-medium">VIE</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="flex text-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <img src="{{ asset('images/flag/canada.jpeg') }}" alt=""
                                                 class="w-5 h-auto block flex-shrink-0">
                                            <span class="ml-2 text-sm font-medium">CAN</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="flex text-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <img src="{{ asset('images/flag/usa.png') }}" alt=""
                                                 class="w-5 h-auto block flex-shrink-0">
                                            <span class="ml-2 text-sm font-medium">USA</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="flex text-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <img src="{{ asset('images/flag/france.png') }}" alt=""
                                                 class="w-5 h-auto block flex-shrink-0">
                                            <span class="ml-2 text-sm font-medium">FRA</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="relative">
                            <div class="flex lg:ml-6" id="dropdownButtonSearch">
                                <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Search</span>
                                    <!-- Heroicon name: outline/search -->
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </a>
                            </div>
                            <div id="dropdownMenuSearch"
                                 class="hidden absolute z-10 w-20 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                <div class="flex justify-center">
                                    <div class="mb-3 xl:w-96">
                                        <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                                            <input type="search"
                                                   class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                   placeholder="Search" aria-label="Search"
                                                   aria-describedby="button-addon2">
                                            <button
                                                class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                                                type="button" id="button-addon2">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="search"
                                                     class="w-4" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 512 512">
                                                    <path fill="currentColor"
                                                          d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="ml-4 flow-root lg:ml-6">
                            <a href="#" class="group flex items-center">
                                <img class="inline object-cover w-12 h-12 mr-2 rounded-full"
                                     src="https://images.pexels.com/photos/2589653/pexels-photo-2589653.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                                     alt="Profile image"/>
                            </a>
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
