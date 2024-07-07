<?php

use Livewire\Volt\Component;
use App\Models\{Comment, Post};
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $posts;

    public function mount()
    {
        $this->getPosts();
    }

    public function getPosts(): void
    {
        $this->posts = Post::whereHas('comments', function($query){
            $query->where('user_id', auth()->id());
        })->with(['image', 'comments'])->latest()->get();
    }
}; ?>

<div>
    @forelse ( $posts as $post )
        <div class="w-full mb-2 bg-white border border-gray-200 rounded-lg shadow" wire:key="{{$post->id}}">
            <div class="px-2 p-2 bg-white border border-gray-200 rounded-lg shadow">
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex">
                        <div class="flex p-2 flex-col items-center">
                            <img class="w-24 h-24 mb-3 rounded-lg  shadow-lg" src="{{ asset('storage/'. $post->image->path) }}" alt="Bonnie image"/>
                        </div>
                        <div class="flex flex-col justify-item-center p-2 leading-normal">
                            <p class="mb-2 font-normal text-gray-700">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-2">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                                {{ $post->title }}
                            </h5>
                        </a>
                        <div class="flex items-center mt-2 mb-2">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <span class="text-sm font-semibold tracking-tight text-gray-900">
                                    Kategori
                                </span>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">
                                {{ $post->category }}
                            </span>
                        </div>
                        
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
            <span class="font-medium">Info alert!</span> Change a few things up and try submitting again.
            </div>
        </div>
    @endforelse
</div>
