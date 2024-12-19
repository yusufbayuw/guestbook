<?php

use App\Livewire\CreateGuest;
use App\Livewire\ShowGuest;
use App\Livewire\ThanksGuest;
use Illuminate\Support\Facades\Route;

Route::get('/', CreateGuest::class);
Route::get('/guest/{uuid}', ShowGuest::class)->name('show_guest');
Route::get('/thanks/{uuid}', ThanksGuest::class)->name('thanks_guest');
