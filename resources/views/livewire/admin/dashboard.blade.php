<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

<div class="p-6 text-gray-900">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">


<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">


<div class="flex items-center mb-5">
    <p class="bg-blue-100 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded dark:bg-blue-200 dark:text-blue-800">8.7</p>
    <p class="ms-2 font-medium text-gray-900">Konten</p>
    <span class="w-1 h-1 mx-2 bg-gray-900 rounded-full dark:bg-gray-500"></span>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">376 reviews</p>
    <a href="#" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Read all reviews</a>
</div>
<div class="gap-8 sm:grid sm:grid-cols-1">
    <div>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Kesehatan') }} </dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: 88%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8.8</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Pendidikan') }} </dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: 89%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8.9</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Makanan') }} </dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: 88%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8.8</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Traveling') }} </dt>
            <dd class="flex items-center">
                <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: 54%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">5.4</span>
            </dd>
        </dl>
    </div>
</div>

    {{-- <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Read more
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a> --}}
</div>

    </div>
</div>

            <div class="p-6 text-gray-900">
                @if (count($posts) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($posts as $post)
                            <div>
                                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-end px-4 pt-4">
                                    </div>
                                    <div class="flex flex-col items-center pb-5">
                                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('storage/'. $post->image->path) }}" alt="Bonnie image"/>
                                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"> {{ $post->title }} </h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400"> {{ $post->category }} </span>
                                        <div class="flex mt-4 md:mt-6">
                                            <span class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                                </svg>
                                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                {{ count($post->comments) }}
                                                </span>
                                            </span>

                                            <span class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="{{count($post->likes) > 0 ? "red" : "none"}}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>
                                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                {{ count($post->likes) }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Data Galeri Photo belum tersedia..</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
