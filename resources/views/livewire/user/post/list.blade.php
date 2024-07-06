<?php

use App\Models\{
    Post, Comment
};
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {

    public Collection $posts;
    public Collection $allComment;

    public ?Post $replying = null;
    public ?Comment $editCommenting = null;

    public $comments;

    public function mount(): void
    {
        $this->getPosts();
    }

    public function comment(Post $post): void
    {
        $this->replying = $post;
        $this->getPosts();

        $this->getAmountComments();
    }

    public function editComment(Comment $comment): void
    {
        $this->editCommenting = $comment;

        $this->getPosts();
    }

    public function deleteComment(Comment $comment): void
    {
        $comment->delete();

        $this->getPosts();
    }

    #[On('post-reply-canceled')]
    public function disableReplying(): void
    {
        $this->replying = null;

        $this->getPosts();
    }

    #[On('post-reply-canceled')]
    public function disableEditCommenting(): void
    {
        $this->editCommenting = null;

        $this->getPosts();
    }

    public function getPosts(): void
    {
        $this->posts = Post::with(['image', 'comments'])->latest()->get();
    }

     #[On(' post-reply-success')]
    public function getAmountComments()
    {
        $this->comments = Post::with('comments')->count();
    }
}; ?>

<div>
    @forelse ( $posts as $post )
        <div class="w-full mb-2 bg-white border border-gray-200 rounded-lg shadow" wire:key="{{$post->id}}">
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
                        <x-dropdown-link wire:click="comment({{ $post->id }})">
                            {{ __('Comment') }}
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="like({{ $post->id }})" wire:confirm="Are you sure to delete this chirp?">
                            {{ __('Like') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            {{-- end dropdown --}}
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
                        @if ($post->is($replying))
                            <livewire:user.post.reply :post="$post" :key="$post->id" />
                        @else
                            @php
                                $userComments = $post->comments->where('user_id', auth()->id())->take(1);
                                $otherComments = $post->comments->where('user_id', '!=', auth()->id())->take(3);
                                $comments = $userComments->merge($otherComments);
                            @endphp
                            @foreach ($comments as $comment)
                                <div class="p-6 flex space-x-2" wire:key="{{ $comment->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="text-gray-800">{{ $comment->user->name }}</span>
                                                <small class="ml-2 text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                                                @unless ($comment->created_at->eq($comment->updated_at))
                                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                                @endunless
                                            </div>
                                            @if ($comment->user->is(auth()->user()))
                                                <x-dropdown>
                                                    <x-slot name="trigger">
                                                        <button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <x-dropdown-link wire:click="editComment({{ $comment->id }})">
                                                            {{ __('Edit') }}
                                                        </x-dropdown-link>
                                                        <x-dropdown-link wire:click="deleteComment({{ $comment->id }})" wire:confirm="Are you sure to delete this comment?"> 
                                                            {{ __('Delete') }}
                                                        </x-dropdown-link> 
                                                    </x-slot>
                                                </x-dropdown>
                                            @endif
                                        </div>
                                        @if ($comment->is($editCommenting))
                                            <livewire:user.post.reply-edit :comment="$comment" :key="$comment->id" />
                                        @else
                                            <p class="mt-4 text-lg text-gray-900">{{ $comment->content }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex mt-2 space-x-2 md:mt-2">
                                <span class="inline-flex items-center text-sm font-medium text-center ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                    </svg>
                                    <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                    {{ count($post->comments) }}
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
            <span class="font-medium">Info alert!</span> Change a few things up and try submitting again.
            </div>
        </div>
    @endforelse
</div>
