<?php

use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

test('trash page lists deleted categories but not active categories', function () {
    $deletedCategory = Category::factory()->create([
        'name' => 'Deleted hand tools',
        'code' => 'DELETED-TOOLS',
    ]);
    $deletedCategory->delete();
    Category::factory()->create([
        'name' => 'Active hand tools',
        'code' => 'ACTIVE-TOOLS',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.trash')
        ->assertSee('Deleted hand tools')
        ->assertDontSee('Active hand tools');
});

test('admins can move a category to trash', function () {
    $category = Category::factory()->create();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.index')
        ->set('deletingId', $category->id)
        ->call('delete')
        ->assertSet('deletingId', null);

    $this->assertSoftDeleted($category);
});

test('admins can restore a trashed category', function () {
    $category = Category::factory()->create();
    $category->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.trash')
        ->call('restore', $category->id);

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'deleted_at' => null,
    ]);
});

test('admins can permanently delete a trashed category', function () {
    $category = Category::factory()->create();
    $category->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.trash')
        ->set('deletingId', $category->id)
        ->call('forceDelete')
        ->assertSet('deletingId', null);

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

test('regular users cannot move categories to trash', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::category.index')
        ->set('deletingId', $category->id)
        ->call('delete')
        ->assertForbidden();

    $this->assertModelExists($category);
});

test('regular users cannot restore trashed categories', function () {
    $category = Category::factory()->create();
    $category->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::category.trash')
        ->call('restore', $category->id)
        ->assertForbidden();

    $this->assertSoftDeleted($category);
});

test('regular users cannot permanently delete trashed categories', function () {
    $category = Category::factory()->create();
    $category->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::category.trash')
        ->set('deletingId', $category->id)
        ->call('forceDelete')
        ->assertForbidden();

    $this->assertSoftDeleted($category);
});
