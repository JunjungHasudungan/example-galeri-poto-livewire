<?php

namespace App\Livewire\User;

use App\Models\Post;
use Livewire\Attributes\{Title, Layout};
use App\Livewire\Forms\User\CommentForm;
use Livewire\Component;

class Dashboard extends Component
{
    public CommentForm $commentForm;

    public $content = '';
    public $post_id = '';

    #[Title('Dashboard')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.dashboard', [
            'posts'     => Post::with(['image'])->get()
        ]);
    }

    public function openModal($postId)
    {
        $this->post_id = $postId;
        $this->dispatch('open-modal');
    }

    public function save()
    {
        dd($this->post_id);
        $this->commentForm->store();
    }

    public function edit()
    {
        dd('tutup modal..');
    }
}
