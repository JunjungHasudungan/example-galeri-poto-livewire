<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\WithFileUploads;
use Livewire\Attributes\{Title, Layout};
use Livewire\Attributes\Validate;
use App\Livewire\Forms\Admin\PostForm;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public ?Post $post;

    public PostForm $postForm;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required')]
    public $category = '';

    #[Validate('required|image|max:1024')] // 1MB Max
    public $image;

    #[Validate('required|image|max:1024')] // 1MB Max
    public $new_image;


    public function mount(Post $post): void
    {
        $this->title = $post->title;
        $this->description =  $post->description;
        $this->category = $post->category;
        $this->image = $post->image;
    }

    #[Title('Galeri')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.posts.edit');
    }

    public function closeEditForm()
    {
        $this->redirectRoute('admin-galeri-photo', absolute:true, navigate:true);
    }

    public function cancel()
    {
        $this->dispatch('close-post-edit');
    }

    public function update()
    {
        $this->validate();

        dd($this->new_image);
        // if (Storage::disk('public')->exists($this->postForm->image)) {
        //         Storage::delete($this->postForm->image);
        //         $newPathImage = $this->postForm->new_image->store('images', 'public');

        //         Image::create([
        //             'post_id'   => $this->post->id,
        //             'path'      => $newPathImage
        //         ]);

        //         $this->post->update([
        //             'title' => $this->postForm->title,
        //             'description' => $this->postForm->description,
        //             'category'  => $this->postForm->category,
        //             'user_id'   => auth()->id()
        //         ]);
        // } else {
        //         $newPathImage = $this->postForm->new_image->store('images', 'public');

        //         Image::create([
        //             'post_id'   => $this->post->id,
        //             'path'      => $newPathImage
        //         ]);

        //         $this->post->update([
        //             'title' => $this->postForm->title,
        //             'description' => $this->postForm->description,
        //             'category'  => $this->postForm->category,
        //             'user_id'   => auth()->id()
        //         ]);
        // }

    }
}
