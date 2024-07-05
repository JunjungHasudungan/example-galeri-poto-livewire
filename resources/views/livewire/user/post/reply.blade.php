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
        $this->content = $this->post;
    }
}; ?>

<div>
    {{ __('HALAMAN REPLY POST') }}
</div>
