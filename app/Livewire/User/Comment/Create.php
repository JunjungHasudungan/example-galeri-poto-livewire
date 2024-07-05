<?php

namespace App\Livewire\User\Comment;

use App\Models\Post;
use Livewire\Component;

class Create extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.user.comment.create');
    }
}
