<?php

namespace App\Livewire\User;

use Livewire\Attributes\{Title, Layout};
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
