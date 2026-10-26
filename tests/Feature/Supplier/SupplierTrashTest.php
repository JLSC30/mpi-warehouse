<?php

use App\Models\Supplier;
use App\Models\User;
use Livewire\Livewire;

test('trash page lists deleted suppliers but not active suppliers', function () {
    $deletedSupplier = Supplier::factory()->create([
        'name' => 'Deleted supplier',
    ]);
    $deletedSupplier->delete();
    Supplier::factory()->create([
        'name' => 'Active supplier',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.trash')
        ->assertSee('Deleted supplier')
        ->assertDontSee('Active supplier');
});

test('admins can move a supplier to trash', function () {
    $supplier = Supplier::factory()->create();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.index')
        ->set('deletingId', $supplier->id)
        ->call('delete')
        ->assertSet('deletingId', null);

    $this->assertSoftDeleted($supplier);
});

test('admins can restore a trashed supplier', function () {
    $supplier = Supplier::factory()->create();
    $supplier->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.trash')
        ->call('restore', $supplier->id);

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'deleted_at' => null,
    ]);
});

test('admins can permanently delete a trashed supplier', function () {
    $supplier = Supplier::factory()->create();
    $supplier->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.trash')
        ->set('deletingId', $supplier->id)
        ->call('forceDelete')
        ->assertSet('deletingId', null);

    $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
});

test('regular users cannot move suppliers to trash', function () {
    $supplier = Supplier::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::supplier.index')
        ->set('deletingId', $supplier->id)
        ->call('delete')
        ->assertForbidden();

    $this->assertModelExists($supplier);
});

test('regular users cannot restore trashed suppliers', function () {
    $supplier = Supplier::factory()->create();
    $supplier->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::supplier.trash')
        ->call('restore', $supplier->id)
        ->assertForbidden();

    $this->assertSoftDeleted($supplier);
});

test('regular users cannot permanently delete trashed suppliers', function () {
    $supplier = Supplier::factory()->create();
    $supplier->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::supplier.trash')
        ->set('deletingId', $supplier->id)
        ->call('forceDelete')
        ->assertForbidden();

    $this->assertSoftDeleted($supplier);
});
