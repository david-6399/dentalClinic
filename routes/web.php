<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

route::livewire('/home', 'pages::guest.home')->name('guest.home');

route::livewire('/doctors', 'pages::guest.doctor')->name('guest.doctor');

route::livewire('/services', 'pages::guest.services')->name('guest.service');

route::livewire('/contact', 'pages::guest.contact')->name('guest.contact');

route::livewire('/about', 'pages::guest.about')->name('guest.about');



route::livewire('/adminlogin', 'pages::auth.login');
    

route::livewire('/dashboard', 'pages::dashboard.main')->name('dashboard');
route::livewire('/dashboard/appointments', 'pages::dashboard.appointement')->name('dashboard.appointments');
route::livewire('/dashboard/patients', 'pages::dashboard.patient')->name('dashboard.patients');
route::livewire('/dashboard/doctors', 'pages::dashboard.doctor')->name('dashboard.doctors');




/////////////////////////////////////////////////////////////


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
