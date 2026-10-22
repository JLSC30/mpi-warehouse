<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('categories', 'pages::category.index')
        ->middleware('can:viewAny,'.Category::class)
        ->name('categories.index');
});

require __DIR__.'/settings.php';
