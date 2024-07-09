<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithPagination;
use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    use WithPagination;

    // public $posts = [];

    // #[On('post-created')]
    public function mount(): void
    {
        // $this->posts = Post::with('image')->paginate(2);
        //  $this->getPostList();
    }

    #[On('post-created')]
    #[On('update-post')]
    public function render()
    {
        // dd($this->posts);
        return view('livewire.admin.posts.post-list', [
            'posts' => Post::with('image')->paginate(2)
        ]);
    }

    #[On('post-created')]
    public function getPostList()
    {
        // $this->posts = Post::paginate(2);
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        $this->dispatch('update-post');
    }
}
