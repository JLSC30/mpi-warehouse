<?php

use App\Models\Location;
use App\Models\User;
use Livewire\Livewire;

test('trash page lists deleted locations but not active locations', function () {
    $deletedLocation = Location::factory()->create([
        'name' => 'Deleted location',
    ]);
    $deletedLocation->delete();
    Location::factory()->create([
        'name' => 'Active location',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.trash')
        ->assertSee('Deleted location')
        ->assertDontSee('Active location');
});

test('admins can move a location to trash', function () {
    $location = Location::factory()->create();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.index')
        ->set('deletingId', $location->id)
        ->call('delete')
        ->assertSet('deletingId', null);

    $this->assertSoftDeleted($location);
});

test('admins can restore a trashed location', function () {
    $location = Location::factory()->create();
    $location->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.trash')
        ->call('restore', $location->id);

    $this->assertDatabaseHas('locations', [
        'id' => $location->id,
        'deleted_at' => null,
    ]);
});

test('admins can permanently delete a trashed location', function () {
    $location = Location::factory()->create();
    $location->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::location.trash')
        ->set('deletingId', $location->id)
        ->call('forceDelete')
        ->assertSet('deletingId', null);

    $this->assertDatabaseMissing('locations', ['id' => $location->id]);
});

test('regular users cannot move locations to trash', function () {
    $location = Location::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::location.index')
        ->set('deletingId', $location->id)
        ->call('delete')
        ->assertForbidden();

    $this->assertModelExists($location);
});

test('regular users cannot restore trashed locations', function () {
    $location = Location::factory()->create();
    $location->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::location.trash')
        ->call('restore', $location->id)
        ->assertForbidden();

    $this->assertSoftDeleted($location);
});

test('regular users cannot permanently delete trashed locations', function () {
    $location = Location::factory()->create();
    $location->delete();
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::location.trash')
        ->set('deletingId', $location->id)
        ->call('forceDelete')
        ->assertForbidden();

    $this->assertSoftDeleted($location);
});
