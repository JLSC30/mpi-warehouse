<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('categories', 'pages::category.index')
        ->middleware('can:viewAny,'.Category::class)
        ->name('categories.index');

    Route::livewire('categories/create', 'pages::category.create')
        ->middleware(['can:viewAny,'.Category::class, 'can:create,'.Category::class])
        ->name('categories.create');

    Route::livewire('categories/trash', 'pages::category.trash')
        ->middleware(['can:viewAny,'.Category::class, 'can:forceDelete,'.Category::class])
        ->name('categories.trash');

    Route::livewire('categories/{category}/edit', 'pages::category.edit')
        ->middleware(['can:viewAny,'.Category::class, 'can:update,'.Category::class])
        ->name('categories.edit');

});

require __DIR__.'/settings.php';
