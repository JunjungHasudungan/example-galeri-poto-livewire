<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Comment;

class CommentForm extends Form
{
    #[Validate('nullable|min:3')]
    public $content = '';

    public function store()
    {
        $validated = $this->validate();


        // Comment::create([
        //     'content'   => $validated['content],
        // ]);
        // if (!empty($this->content)) {
        //     dd($validaed);
        // }

    }
}
