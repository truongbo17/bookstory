<div class="bg-gray-50">
    <div class="mt-4 bg-gray-50 pb-16 sm:mt-8 sm:pb-20 lg:pb-28">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form wire:submit.prevent="submit">
                    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
                        <div class="flex-1 bg-gray-50 px-6 py-8 lg:p-12">
                            <h3 class="text-2xl font-extrabold text-indigo-600 sm:text-3xl">
                                Bookstory - Tải xuống tất cả tài liệu <span class="text-red-700">miễn phí</span> từ
                                pesthubt.com
                            </h3>
                            <p class="mt-6 text-sm font-medium text-black text-base">
                                Nhập link quiz bạn cần tải ở phía dưới .
                            </p>
                            <p class="mt-6 text-sm text-black text-base"> Ví dụ :
                                <span class="text-blue-800">https://pesthubt.com/quiz/15486/ha4-unit-1234.html</span>
                            </p>
                            <div class="mt-8">

                                <div class="mt-1">
                                    <input type="text" wire:model="link" id="link"
                                           class="my-5 block w-full shadow-sm text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                                           placeholder="https://pesthubt.com/quiz/15486/ha4-unit-1234.html"
                                           autofocus autocomplete="link">

                                    <div class="grid grid-cols-4 gap-2">
                                        <div class="text-sm my-5 py-2">Chọn định dạng tải xuống :</div>
                                        <div class="col-span-3">
                                            <select id="location" wire:model="type"
                                                    class="text-sm my-5 block w-full shadow-sm text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                                <option selected>Chọn định dạng</option>
                                                <option value="pdf">PDF</option>
                                                <option value="text">Text</option>
                                                <option value="docx">Docx</option>
                                                <option value="xml">XML</option>
                                            </select>
                                        </div>
                                    </div>

                                    <p class="mb-6 text-sm font-bold text-red-700">
                                        * Nếu quiz nhiều câu hỏi, thời gian xử lý có thể mất tới 20 giây hoặc hơn !!!
                                    </p>
                                    @error('link')
                                    <div id="alert-1" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200"
                                         role="alert">
                                        <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                                            {{ $message }}
                                        </div>
                                        <button type="button"
                                                class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                                                data-dismiss-target="#alert-1" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @enderror
                                    @error('type')
                                    <div id="alert-1" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200"
                                         role="alert">
                                        <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                                            {{ $message }}
                                        </div>
                                        <button type="button"
                                                class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                                                data-dismiss-target="#alert-1" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @enderror
                                    @if (session()->has('error'))
                                        <div id="alert-0" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200"
                                             role="alert">
                                            <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                                                {{ session('error') }}
                                            </div>
                                            <button type="button"
                                                    class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                                                    data-dismiss-target="#alert-0" aria-label="Close">
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
                                    @if (session()->has('success'))
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
                                                {{session('success')}}
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
                                </div>

                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 pr-4 bg-gray-50 text-sm tracking-wider font-semibold uppercase text-indigo-600">
                                        About me ?
                                    </h4>
                                    <div class="flex-1 border-t-2 border-gray-200"></div>
                                </div>
                                <ul role="list"
                                    class="mt-8 space-y-5 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
                                    <li class="flex items-start lg:col-span-1">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">
                                            Đạt 5000 lượt sử dụng sau 1 tuần
                                        </p>
                                    </li>

                                    <li class="flex items-start lg:col-span-1">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">
                                            Hoàn toàn miễn phí,bảo mật
                                        </p>
                                    </li>

                                    <li class="flex items-start lg:col-span-1">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">
                                            Tốc độ xử lý nhanh chóng
                                        </p>
                                    </li>

                                    <li class="flex items-start lg:col-span-1">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">
                                            Định dạng file PDF,DOCX,TEXT,...
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div
                            class="py-8 px-6 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                            <p class="text-lg leading-6 font-medium text-gray-900">
                                Tải xuống ngay bây giờ
                            </p>
                            <div class="mt-4 flex items-center justify-center text-5xl font-extrabold text-gray-900">
              <span class="text-primary">
                0đ
              </span>
                                <span class="ml-3 text-xl font-medium text-gray-500">
                VND
              </span>
                            </div>
                            <p class="mt-4 text-sm"></p>
                            <div class="mt-6">
                                <div class="rounded-md shadow">
                                    <button type="submit"
                                            class="flex w-full items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-900">
                                        Tải xuống
                                    </button>
                                    <div wire:loading>
                                        <div class="loading">Loading&#8230;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-sm">
                                <a href="https://www.facebook.com/profile.php?id=100076330325908" target="_blank">
                                    <p class="font-medium text-gray-900">
                                        Develop by
                                        <span class="font-normal text-gray-500">
                  Nguyễn Quang Trường
                </span>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
