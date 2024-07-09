<?php

use App\Livewire\Admin\{
    Dashboard as AdminDashboard
};
use App\Livewire\Admin\Posts\{
    Create as AdminCreateGaleri,
    Index as AdminIndexGaleri,
    Edit as AdminEditGaleri
};
use App\Livewire\User\{
    Dashboard as UserDashboard
};

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\User\{
    DashboardController as UserDashbardController,
    CommentController as UserCommentController,
    LikeController as UserLikeController,
};
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile', ['title'=> 'Profile'])
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function(){
    // ROUTE FOR ADMIN
    Route::get('admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
    // Route::get('galeri-photo', AdminIndexGaleri::class)->name('admin-galeri-photo');
    Route::get('galeri-photo', [PostController::class, 'index'])->name('admin-galeri-photo');
    Route::get('galeri-photo-create', AdminCreateGaleri::class)->name('admin-galeri-photo-create');
    Route::get('galeri-photo-edit/{post}', AdminEditGaleri::class)->name('admin-galeri-photo-edit');

    // ROUTE FOR USER
    Route::get('user-dashboard', [UserDashbardController::class, 'index'])->name('user-dashboard');
    Route::get('user-comments', [UserCommentController::class, 'index'])->name('user-comments');
    Route::get('user-likes', [UserLikeController::class, 'index'])->name('user-likes');
    Route::get('chirps', [ChirpController::class, 'index'])->name('chirps');
});

require __DIR__.'/auth.php';
