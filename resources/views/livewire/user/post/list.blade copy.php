<?php

use App\Models\Post;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {

    public Collection $posts;

    public ?Post $editing = null;

    public function mount(): void
    {
        $this->getPosts();
    }

    public function edit(Post $post): void
    {
        $this->editing = $post;

        $this->getPosts();
    }

    public function getPosts(): void
    {
        $this->posts = Post::with(['image', 'comments'])->latest()->get();
    }
}; ?>

<div>
    @forelse ( $posts as $post )
        <div class="w-full mb-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            {{-- dropdown --}}
            <div class="flex justify-end px-2 pt-2">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="edit({{ $post->id }})">
                            {{ __('Comment') }}
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="like({{ $post->id }})" wire:confirm="Are you sure to delete this chirp?">
                            {{ __('Like') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @if ($post->is($editing))
                    <p class="text-white" > {{ __('Halalaman untuk Reply Postingan..') }} </p>
                @else
                    <p class="text-white"> {{ __('Tidak Melakukan Reply Postingan') }} </p>
                @endif
            </div>
            {{-- end dropdown --}}
            <div class="px-2 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex">
                        <div class="flex p-2 flex-col items-center">
                            <img class="w-24 h-24 mb-3 rounded-lg  shadow-lg" src="{{ asset('storage/'. $post->image->path) }}" alt="Bonnie image"/>
                        </div>
                        <div class="flex flex-col justify-item-center p-2 leading-normal">
                            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-2">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </h5>
                        </a>
                        <div class="flex items-center mt-2 mb-2">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <span class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
                                    Kategori
                                </span>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">
                                {{ $post->category }}
                            </span>
                        </div>
                        <div class="flex mt-2 space-x-2 md:mt-2">
                            <span class="inline-flex items-center text-sm font-medium text-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                </svg>
                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                2
                                </span>
                            </span>
                            <span  class="inline-flex items-center text-sm font-medium text-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                2
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty

    @endforelse
</div>
