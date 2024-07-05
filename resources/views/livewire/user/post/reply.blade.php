<?php

use App\Models\Post;
use Livewire\Attributes\Validate; 
use Livewire\Volt\Component;

new class extends Component {
    public Post $post;

      #[Validate('required|string|max:255')]
      public string $content = '';




      public function mount(): void
    {
        $this->content = '';
    }

    public function cancel(): void
    {
        $this->dispatch('post-reply-canceled');
    }  
}; ?>

<div>
    <form wire:submit="update"> 
        <textarea
            wire:model="content"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>
 
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
    </form> 
</div>
