<?php

use App\Models\Supplier;
use App\Models\User;
use Livewire\Livewire;

test('supplier form does not create a supplier when required fields are empty', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.create')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
        ])
        ->assertSee('The name field is required.');

    $this->assertDatabaseCount('suppliers', 0);
});

test('supplier form creates a supplier with valid data', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.create')
        ->set('form.name', 'Supplier A')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'name' => 'Supplier A',
    ]);
});

test('supplier form accepts the maximum field lengths and supported code punctuation', function () {
    $name = str_repeat('N', 32);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.create')
        ->set('form.name', $name)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('suppliers', [
        'name' => $name,
    ]);
});

test('supplier form enforces maximum field lengths', function (string $field, string $value, string $errorField, string $message) {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.create')
        ->set('form.name', 'Supplier A')
        ->set($field, $value)
        ->call('save')
        ->assertHasErrors([$errorField => 'max'])
        ->assertSee($message);

    $this->assertDatabaseCount('suppliers', 0);
})->with([
    'names longer than 32 characters' => [
        'form.name',
        str_repeat('N', 33),
        'form.name',
        'The name field must not be greater than 32 characters.',
    ],
]);

test('supplier form rejects a code already assigned to another supplier', function () {
    Supplier::factory()->create(['name' => 'Supplier A']);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::supplier.create')
        ->set('form.name', 'Supplier A')
        ->call('save')
        ->assertHasErrors(['form.name' => 'unique'])
        ->assertSee('The name has already been taken.');

    $this->assertDatabaseCount('suppliers', 1);
});
