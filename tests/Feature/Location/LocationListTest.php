<?php

use App\Models\Location;
use App\Models\User;

test('location list shows the total number of location across pages', function () {
    Location::factory()->count(20)->create();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('locations.index'))
        ->assertOk()
        ->assertSee('20 locations');
});

test('location search matches names', function () {
    Location::factory()->create([
        'name' => 'Shelf A',
    ]);
    Location::factory()->create([
        'name' => 'Shelf B',
    ]);
    Location::factory()->create([
        'name' => 'Shelf C',
    ]);

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('locations.index', ['search' => 'Shelf']))
        ->assertOk()
        ->assertSee('Shelf A')
        ->assertSee('Shelf B')
        ->assertDontSee('Shelf D');
});

test('locations list does not show categories in the trash', function () {
    $location = Location::factory()->create([
        'name' => 'Deleted location',
    ]);
    $location->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('locations.index'))
        ->assertOk()
        ->assertDontSee('Deleted location')
        ->assertSee('No location found');
});
