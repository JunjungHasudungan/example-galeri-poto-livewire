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

    public ?Post $post;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required')]
    public $category = '';

    #[Validate('required|image|max:1024')] // 1MB Max
    public $image;

    #[Validate('nullable|image|max:1024')] // 1MB Max
    public $new_image;


    public function store()
    {
        $validated = $this->validate();

        $post = Post::create([
            'title' => $validated['title'],
            'description'   => $validated['description'],
            'category'      => $validated['category'],
            'user_id'       => auth()->id()
        ]);

        $pathImage = $this->image->store('images', 'public');

        Image::create([
            'post_id'   => $post->id,
            'path'      => $pathImage
        ]);

        $this->reset();
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->category = $post->category;
        $this->description = $post->description;
        $image = Image::where('post_id', $post->id)->first();

        if ($image) {
            $this->image = $image->path;
        }
    }

    public function update()
    {

        $this->validate();
        dd($this->validate());

        $this->post->update(
            $this->all()
        );

        $this->reset();

        dd('berhasil mengupdate..');
    }
}
