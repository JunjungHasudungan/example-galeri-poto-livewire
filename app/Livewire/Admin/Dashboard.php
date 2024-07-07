<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\{Title, Layout};
use Livewire\Component;
use App\Models\Post;
class Dashboard extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::with(['image', 'comments', 'likes'])->get();
    }

    #[Title('Dashboard')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'posts' => $this->posts
        ]);
    }
}
