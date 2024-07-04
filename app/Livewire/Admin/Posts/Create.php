<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Attributes\{Title, Layout};
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Livewire\Forms\Admin\PostForm;

class Create extends Component
{
    use WithFileUploads;

    public PostForm $postForm;

    #[Validate('image|max:1024')] // 1MB Max
    public $image = '';

    #[Title('Galeri')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.posts.create');
    }

    public function save()
    {
        $this->postForm->store();

        $this->redirectIntended(default: route('admin-galeri-photo', absolute: false), navigate: true);
    }

    public function closeForm()
    {
        $this->redirectIntended(default: route('admin-galeri-photo', absolute: false), navigate: true);
    }
}
