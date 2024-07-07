<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Attributes\{Title, Layout};
use Livewire\Component;
use App\Models\Post;

class Index extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::with([''])->get();
    }

    #[Title('Galeri')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.posts.index', [
            'posts' => Post::with('image')->get()
        ]);
    }
}
