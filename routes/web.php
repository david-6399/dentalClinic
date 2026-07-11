<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

route::livewire('/home', 'pages::guest.home')->name('guest.home');

route::livewire('/doctors', 'pages::guest.doctor')->name('guest.doctor');

route::livewire('/services', 'pages::guest.services')->name('guest.service');

route::livewire('/contact', 'pages::guest.contact')->name('guest.contact');

route::livewire('/about', 'pages::guest.about')->name('guest.about');








/////////////////////////////////////////////////////////////

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
