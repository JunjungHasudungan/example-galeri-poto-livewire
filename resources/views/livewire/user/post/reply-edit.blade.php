<?php

use Livewire\Volt\Component;
use App\Models\Comment;
use Livewire\Attributes\Validate;

new class extends Component {

    public Comment $comment;

    #[Validate('required', message: 'Komentar wajib diisi..')]
    public string $content = '';

    public function mount(): void
    {
        $this->content = $this->comment->content;
    }

    public function updateComment()
    {
        $validated = $this->validate();

        $this->comment->update($validated);

        $this->dispatch('post-reply-canceled');
    }
    public function cancel(): void
    {
        $this->dispatch('post-reply-canceled');
    }

}; ?>

<div>
    <form wire:submit="updateComment">
        <textarea
            wire:model="content"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>

        <x-input-error :messages="$errors->get('content')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
    </form>
</div>
