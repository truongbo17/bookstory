@extends('main')

@section('title', __('Profile'))

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
        @include('user.layout.sidebar_mobile')
        @include('user.layout.sidebar')

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                @include('user.layout.open_sidebar_mobile')
            </div>
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{__('Dashbroad')}} - {{__('Profile')}}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto pl-4 sm:pl-6 md:pl-8">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            <div class="border-4 border-dashed border-gray-200 rounded-lg h-full">

                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                        <dl class="sm:divide-y sm:divide-gray-200">
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{__('Full name')}}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{auth()->user()->name}}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{__('Role')}}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{auth()->user()->is_admin ? 'Admin' : 'Author'}}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Email address
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{auth()->user()->email}}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{__('Total Document')}}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{count(auth()->user()->documents)}}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{__('Join date')}}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{\Carbon\Carbon::parse(auth()->user()->created_at)->format('H:i d-m-Y')}}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{__('Action')}}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <ul role="list"
                                                        class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                            <div class="w-0 flex-1 flex items-center">
                                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                     fill="none" stroke="currentColor"
                                                                     viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                                <span class="ml-2 flex-1 w-0 truncate">
                  {{__('Edit Profile')}}
                </span>
                                                            </div>
                                                            <div class="ml-4 flex-shrink-0">
                                                                <a href="{{route('user.dashbroad_edit')}}"
                                                                   class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                    {{__('Edit')}}
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                            <div class="w-0 flex-1 flex items-center">
                                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                     fill="none" stroke="currentColor"
                                                                     viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path>
                                                                </svg>
                                                                <span class="ml-2 flex-1 w-0 truncate">
                  {{__('Deactive your account')}}
                </span>
                                                            </div>
                                                            <div class="ml-4 flex-shrink-0">
                                                                <button
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                                                    type="button"
                                                                    data-modal-toggle="deactive-modal">
                                                                    {{__('Deactive')}}
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Main deactive -->
    <div id="deactive-modal" tabindex="-1" data-modal-placement="top-center" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-end p-2">
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-toggle="deactive-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="deactiveForm" class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8"
                      action="{{route('user.deactive')}}"
                      method="POST">
                    <h3 class="text-sm font-medium text-red-600 dark:text-white">{{__('After deactivating your account, you will not be able to access your account again. However, your documents will still be displayed')}}</h3>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Enter password to continue')}}</label>
                        <input id="inputDeactive" type="password" name="password" id="password" placeholder="••••••••"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        <span id="spanDeactive" class="text-red-700 text-sm mt-1"></span>
                    </div>
                    <button type="submit"
                            class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        {{__('Deactive your account')}}
                    </button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        {{__('Privacy')}}? <a href="{{route('privacy.index')}}"
                                    class="text-indigo-700 hover:underline dark:text-indigo-500">{{__('Read now')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script>
        const URL_DEACTIVE = '{{route('user.deactive')}}';
        const deactiveForm = document.getElementById('deactiveForm');
        const inputDeactive = document.getElementById('inputDeactive');
        const span = document.getElementById('spanDeactive');
        deactiveForm.addEventListener('submit', (e) => {
            e.preventDefault();
            //password
            const password = deactiveForm.querySelector('input[name="password"]').value;

            //fetch api
            fetch(URL_DEACTIVE, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    '_token': '{{csrf_token()}}',
                    'password': password,
                }),
            })
                .then(
                    function (response) {
                        if (response.status === 200) {
                            span.innerText = "Deactive success !!!";
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 400);
                        }
                        // parse response data
                        response.json().then(data => {
                            inputDeactive.classList.add('border-red-500', 'text-pink-600', 'focus:border-pink-500', 'focus:ring-pink-500');
                            span.innerText = data.message;
                        })
                    }
                )
        });

    </script>
@endpush
