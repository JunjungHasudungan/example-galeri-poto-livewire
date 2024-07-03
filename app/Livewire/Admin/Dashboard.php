<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\{Title, Layout};
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
