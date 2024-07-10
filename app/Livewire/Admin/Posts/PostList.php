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

    public Collection $lisPost;

    public ?Post $editPosting = null;

    // #[On('post-created')]
    public function mount(): void
    {
         $this->getPostList();
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

    public function getPosts(): void
    {
        $this->lisPost = Post::with(['image', 'comments', 'likes'])->latest()->get();
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        $this->dispatch('update-post');
    }

    public function editPost(Post $post)
    {
        $this->editPosting = $post;

        $this->getPosts();
    }

    #[On('close-post-edit')]
    public function disableEditingPost(): void
    {

        $this->editPosting = null;
        
        $this->getPosts();
    }
}
