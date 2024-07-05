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

        $this->getPost();
    }

    public function getPosts(): void
    {
        $this->posts = Post::with(['image', 'comments'])->latest()->get();
    }
}; ?>

<div>
    @forelse ($posts as $post)
        <div class="p-6 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{ asset('storage/'. $post->image->path) }}" alt="">
                <div class="flex flex-col p-4 leading-normal">

                    <div class="flex items-center space-x-5">
                        <h5 class="inline-flex mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $post->title }} </h5>
                        <div class="item-center flex mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"> {{ $post->category }} </span>
                        </div>
                    </div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                       {{ $post->description }}
                    </p>
                </div>
            </div>
            <div class="flex mt-2 md:mt-3 space-x-3">
                @if($post->is($editing))
                    <livewire:user.post.reply :post="$post" :key="$post->id"/>
                @else
                    <button type="button" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                        <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                        2
                        </span>
                </button>
                @endif
                <button type="button" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    2
                    </span>
                </button>
            </div>
        </div>
    @empty
        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Warning alert!</span> Change a few things up and try submitting again.
            </div>
        </div>
    @endforelse
</div>
