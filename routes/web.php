<?php

use App\Livewire\Admin\{
    Dashboard as AdminDashboard
};
use App\Livewire\Admin\Posts\{
    Create as AdminCreateGaleri,
    Index as AdminIndexGaleri
};
use App\Livewire\User\{
    Dashboard as UserDashboard
};
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function(){
    // ROUTE FOR ADMIN
    Route::get('admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
    Route::get('galeri-photo', AdminIndexGaleri::class)->name('admin-galeri-photo');
    Route::get('galeri-photo-create', AdminCreateGaleri::class)->name('admin-galeri-photo-create');

    // ROUTE FOR USER
    Route::get('user-dashbaord', UserDashboard::class)->name('user-dashboard');
});

require __DIR__.'/auth.php';
