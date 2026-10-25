<?php

use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Category route
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

    // Location route
    Route::livewire('locations', 'pages::location.index')
        ->middleware('can:viewAny,'.Location::class)
        ->name('locations.index');

    Route::livewire('locations/create', 'pages::location.create')
        ->middleware(['can:viewAny,'.Location::class, 'can:create,'.Location::class])
        ->name('locations.create');

    Route::livewire('locations/trash', 'pages::location.trash')
        ->middleware(['can:viewAny,'.Location::class, 'can:forceDelete,'.Location::class])
        ->name('locations.trash');

    Route::livewire('locations/{location}/edit', 'pages::location.edit')
        ->middleware(['can:viewAny,'.Location::class, 'can:update,'.Location::class])
        ->name('locations.edit');

});

require __DIR__.'/settings.php';
