<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Image;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;
use App\Models\Post;

class PostForm extends Form
{
    use WithFileUploads;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required')]
    public $category = '';

    #[Validate('image|max:1024')] // 1MB Max
    public $image;

    public function store()
    {
        $validated = $this->validate();

        $post = Post::create([
            'title' => $validated['title'],
            'description'   => $validated['description'],
            'category'      => $validated['category'],
            'user_id'       => auth()->id()
        ]);

        $this->image->storeAs(path: 'photos', name: $this->image->getClientOriginalName());
        // Image::create([
        //     'post_id'   => $post->id,
        // ]);
    }
}
