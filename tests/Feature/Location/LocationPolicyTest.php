<?php

use App\Models\Location;
use App\Models\User;
use App\Policies\LocationPolicy;

test('only admins are authorized for location policy abilities', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $normalUser = User::factory()->create();
    $location = Location::factory()->make();
    $policy = new LocationPolicy;

    $abilities = [
        'viewAny' => [],
        'view' => [$location],
        'create' => [],
        'update' => [$location],
        'delete' => [$location],
        'restore' => [$location],
        'forceDelete' => [$location],
    ];

    foreach ($abilities as $ability => $arguments) {
        expect($policy->{$ability}($admin, ...$arguments))->toBeTrue();
        expect($policy->{$ability}($normalUser, ...$arguments))->toBeFalse();
    }
});

test('normal users cannot visit the location page', function () {
    $normalUser = User::factory()->create();

    $this->actingAs($normalUser)
        ->get(route('locations.index'))
        ->assertForbidden();
});

test('guests are redirected to login from the location page', function () {
    $this->get(route('locations.index'))
        ->assertRedirect(route('login'));
});

test('normal users cannot access location creation, editing, or trash pages', function () {
    $normalUser = User::factory()->create();
    $location = Location::factory()->create();

    $this->actingAs($normalUser);

    $this->get(route('locations.create'))->assertForbidden();
    $this->get(route('locations.edit', $location))->assertForbidden();
    $this->get(route('locations.trash'))->assertForbidden();
});

test('admins can visit the location page', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('locations.index'))
        ->assertOk();
});

test('admins can access location creation, editing, and trash pages', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $location = Location::factory()->create();

    $this->actingAs($admin);

    $this->get(route('locations.create'))
        ->assertOk()
        ->assertSee('New Location')
        ->assertSee('Name');

    $this->get(route('locations.edit', $location))
        ->assertOk()
        ->assertSee('Edit '.$location->name);

    $this->get(route('locations.trash'))
        ->assertOk()
        ->assertSee('Trash');
});
