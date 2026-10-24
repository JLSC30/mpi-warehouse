<?php

use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

/**
 * Ensure valid changes are saved when the category keeps its existing unique code.
 */
test('category form updates a category with valid data', function () {
    $category = Category::factory()->create([
        'name' => 'Old name',
        'code' => 'TOOLS',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.edit', ['category' => $category])
        ->set('form.name', 'New name')
        ->set('form.code', 'TOOLS')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'New name',
        'code' => 'TOOLS',
    ]);
});

/**
 * Ensure invalid update data is rejected without changing the stored category.
 */
test('category form does not update a category when required fields are empty', function () {
    $category = Category::factory()->create([
        'name' => 'Tools',
        'code' => 'TOOLS',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.edit', ['category' => $category])
        ->set('form.name', '')
        ->set('form.code', '')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
            'form.code' => 'required',
        ])
        ->assertSee('The name field is required.')
        ->assertSee('The code field is required.');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Tools',
        'code' => 'TOOLS',
    ]);
});

/**
 * Ensure a category cannot take a code already assigned to another category.
 */
test('category form rejects a code used by another category', function () {
    $category = Category::factory()->create([
        'name' => 'Tools',
        'code' => 'TOOLS',
    ]);
    Category::factory()->create([
        'name' => 'Hardware',
        'code' => 'HARDWARE',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.edit', ['category' => $category])
        ->set('form.name', 'Tools')
        ->set('form.code', 'HARDWARE')
        ->call('save')
        ->assertHasErrors(['form.code' => 'unique']);

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Tools',
        'code' => 'TOOLS',
    ]);
});
