<div class="bg-gray-50 pt-4">
    <footer id="footer" class="relative z-50">
        <div class="py-6 flex flex-col justify-center items-center">
            <a class="focus:outline-none" tabindex="0" role="link" aria-label="home link"
               href="{{route('home.index')}}">
                <img class="dark:hidden" src="{{ asset('images/logo/logo_bookstory.png') }}" alt="tuk logo">
                <img class="dark:block hidden" src="{{ asset('images/logo/logo_bookstory.png') }}" alt="tuk logo">
            </a>
            <div class="flex -space-x-1 overflow-hidden">
                <a href="">
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                         src="{{ asset('images/social/facebook.png') }}" alt="facebook">
                </a>
                <a href="">
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                         src="{{ asset('images/social/twitter.png') }}" alt="facebook">
                </a>
                <a href="">
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                         src="{{ asset('images/social/pinteres.png') }}" alt="facebook">
                </a>
            </div>
            <p tabindex="0"
               class="focus:outline-none mt-6 text-xs lg:text-sm leading-none text-gray-900 dark:text-gray-50">
                @Coppyright 2022 BookStory .</p>
        </div>

        <!-- Back to top button -->
        <button type="button" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block p-3 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out hidden bottom-5 right-5 fixed"
                id="btn-back-to-top">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-4 h-4" role="img"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor"
                      d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z">
                </path>
            </svg>
        </button>
    </footer>
</div>

<script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    // Get the button
    let mybutton = document.getElementById('btn-back-to-top');

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = 'block';
        } else {
            mybutton.style.display = 'none';
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener('click', backToTop);

    function backToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
