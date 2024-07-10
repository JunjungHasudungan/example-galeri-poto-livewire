<div class="py-2">
    <div>
        @forelse ($posts as $post)
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    <div class="w-full border rounded-lg shadow bg-gray-600">
                        <div class="flex justify-end px-4 pt-4">
                            @if ($post->user->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link
                                        wire:click="editPost({{$post->id}})">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        wire:click="deletePost({{$post->id}})"
                                        wire:confirm="yakin untuk dihapus?"
                                            >
                                        {{ __('Hapus') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            @endif
                        </div>
                        @if ($post->is($editPosting))
                            <livewire:admin.posts.edit :post="$post" :key="$post->id" />
                        @else
                            <div class="flex flex-col items-center bg-white shadow md:flex-row md:max-w-xl  dark:bg-gray-600">
                                <div class="p-2">
                                    @if ($post->image)
                                        <img class="rounded-lg h-24 w-24"  src="{{ asset('storage/'. $post->image->path) }}" alt="">
                                    @else
                                        <img class="rounded-lg h-24 w-24"  src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-11.jpg" alt="">
                                    @endif
                                </div>
                                <div class="flex flex-col justify-between p-2 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $post->title }} </h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"> {{ $post->description }} </p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2 mb-2">
                                <div class="flex items-center">
                                    <h5 class="h-auto w-auto text-sm text-blue-600 font-semibold p-2"> Kategori </h5>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3"> {{ $post->category }} </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Post Galeri belum tersedia..</span>
            </div>
          </div>
        @endforelse
    </div>
    {{ $posts->links() }}
</div>
