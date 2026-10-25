<?php

use App\Models\Location;
use App\Models\User;
use Livewire\Livewire;

test('location form updates a location with valid data', function () {
    $location = Location::factory()->create([
        'name' => 'Old name',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.edit', ['location' => $location])
        ->set('form.name', 'New name')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('locations.index'));

    $this->assertDatabaseHas('locations', [
        'id' => $location->id,
        'name' => 'New name',
    ]);
});

test('location form does not update a location when required fields are empty', function () {
    $location = Location::factory()->create([
        'name' => 'Shelf A',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.edit', ['location' => $location])
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
        ])
        ->assertSee('The name field is required.');

    $this->assertDatabaseHas('locations', [
        'id' => $location->id,
        'name' => 'Shelf A',
    ]);
});

test('location form rejects a name used by another location', function () {
    $location = Location::factory()->create([
        'name' => 'Shelf A',
    ]);
    Location::factory()->create([
        'name' => 'Shelf B',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.edit', ['location' => $location])
        ->set('form.name', 'Shelf B')
        ->call('save')
        ->assertHasErrors(['form.name' => 'unique']);

    $this->assertDatabaseHas('locations', [
        'id' => $location->id,
        'name' => 'Shelf A',
    ]);
});
