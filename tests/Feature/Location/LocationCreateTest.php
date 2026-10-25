<?php

use App\Models\Location;
use App\Models\User;
use Livewire\Livewire;

test('location form does not create a location when required fields are empty', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.create')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
        ])
        ->assertSee('The name field is required.');

    $this->assertDatabaseCount('locations', 0);
});

test('location form creates a location with valid data', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.create')
        ->set('form.name', 'Shelf A')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('locations.index'));

    $this->assertDatabaseHas('locations', [
        'name' => 'Shelf A',
    ]);
});

test('location form accepts the maximum field lengths and supported code punctuation', function () {
    $name = str_repeat('N', 32);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.create')
        ->set('form.name', $name)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('locations', [
        'name' => $name,
    ]);
});

test('location form enforces maximum field lengths', function (string $field, string $value, string $errorField, string $message) {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.create')
        ->set('form.name', 'Shelf A')
        ->set($field, $value)
        ->call('save')
        ->assertHasErrors([$errorField => 'max'])
        ->assertSee($message);

    $this->assertDatabaseCount('locations', 0);
})->with([
    'names longer than 32 characters' => [
        'form.name',
        str_repeat('N', 33),
        'form.name',
        'The name field must not be greater than 32 characters.',
    ],
]);

test('location form rejects a code already assigned to another location', function () {
    Location::factory()->create(['name' => 'Shelf A']);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.create')
        ->set('form.name', 'Shelf A')
        ->call('save')
        ->assertHasErrors(['form.name' => 'unique'])
        ->assertSee('The name has already been taken.');

    $this->assertDatabaseCount('locations', 1);
});
