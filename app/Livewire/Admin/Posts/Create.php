<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\{Title, Layout};
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\{Image, Post};
use App\Livewire\Forms\Admin\PostForm;

class Create extends Component
{
    use WithFileUploads;

    public PostForm $postForm;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required')]
    public $category = '';

    #[Validate('required|image|max:1024')] // 1MB Max
    public $image;

    #[Title('Galeri')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.posts.create');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description'  => 'required|min:5',
            'category' => 'required',
            'image'     => 'required|image|max:1024'
        ]);

        $post = Post::create([
            'title' => $this->title,
            'description'   => $this->description,
            'category'      => $this->category,
            'user_id'       => auth()->id()
        ]);

        $pathImage = $this->image->store('images', 'public');

        Image::create([
            'post_id'   => $post->id,
            'path'      => $pathImage
        ]);

        $this->dispatch('post-saved');
        $this->reset();

        $this->dispatch('post-created');

    }

    public function closeForm()
    {
        $this->redirectRoute('admin-galeri-photo', absolute:true, navigate:true);
    }
}
