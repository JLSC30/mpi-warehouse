<?php

use App\Models\Supplier;
use App\Models\User;
use Livewire\Livewire;

test('supplier form updates a supplier with valid data', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Old name',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.edit', ['supplier' => $supplier])
        ->set('form.name', 'New name')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'New name',
    ]);
});

test('supplier form does not update a supplier when required fields are empty', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Supplier A',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.edit', ['supplier' => $supplier])
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
        ])
        ->assertSee('The name field is required.');

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Supplier A',
    ]);
});

test('supplier form rejects a name used by another supplier', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Supplier A',
    ]);
    Supplier::factory()->create([
        'name' => 'Supplier B',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.edit', ['supplier' => $supplier])
        ->set('form.name', 'Supplier B')
        ->call('save')
        ->assertHasErrors(['form.name' => 'unique']);

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Supplier A',
    ]);
});
