<!-- Modal user toggle -->
<button
    class="block text-gray-400 hover:text-gray-700 font-medium rounded-lg text-sm pl-5 py-2.5 text-center"
    type="button" data-modal-toggle="authentication-modal">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
</button>

<!-- Main user login modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="authentication-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="#">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to BookStory</h3>
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                        email</label>
                    <input type="email" name="email" id="email"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required>
                </div>
                <div class="flex justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox"
                                   class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-indigo-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800"
                                   required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember"
                                   class="font-medium text-gray-900 dark:text-gray-300">Remember
                                me</label>
                        </div>
                    </div>
                    <a href="#"
                       class="text-sm text-indigo-700 hover:underline dark:text-indigo-500">Lost
                        Password?</a>
                </div>
                <button type="submit"
                        class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    Login
                </button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a onclick="registerDisplay()"
                                       class="text-indigo-700 hover:underline dark:text-indigo-500">Create
                        account</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Main user register modal -->
<div id="authentication-modal1" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="authentication-modal1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="#">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sign up to BookStory</h3>
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                        email</label>
                    <input type="email" name="email" id="email"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required>
                </div>
                <div class="flex justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox"
                                   class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-indigo-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800"
                                   required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember"
                                   class="font-medium text-gray-900 dark:text-gray-300">Remember
                                me</label>
                        </div>
                    </div>
                    <a href="#"
                       class="text-sm text-indigo-700 hover:underline dark:text-indigo-500">Lost
                        Password?</a>
                </div>
                <button type="submit"
                        class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    Login
                </button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Already registered? <a onclick="loginDisplay()"
                                           class="text-indigo-700 hover:underline dark:text-indigo-500">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Avatar -->
{{--                        <div class="ml-4 flow-root lg:ml-6">--}}
{{--                            <a href="#" class="group flex items-center">--}}
{{--                                <img class="inline object-cover w-12 h-12 mr-2 rounded-full"--}}
{{--                                     src="https://images.pexels.com/photos/2589653/pexels-photo-2589653.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"--}}
{{--                                     alt="Profile image"/>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--Flag--}}

<script>
    var login = document.getElementById('authentication-modal');
    var register = document.getElementById('authentication-modal1');

    function registerDisplay() {
        login.classList.add('hidden');
        register.classList.remove('hidden');
    }

    function loginDisplay() {
        login.classList.remove('hidden');
        register.classList.add('hidden');
    }

    function closeRegister() {
        register.classList.add('hidden');
    }
</script>
