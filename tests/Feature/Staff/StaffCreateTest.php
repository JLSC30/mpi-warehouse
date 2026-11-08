<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Staff;

test('staff form creates a staff member with the selected user and active state', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $user = User::factory()->create();

    $this->actingAs($admin);

    Livewire::test('pages::staff.create')
        ->set('form.name', 'Staff A')
        ->set('form.is_active', false)
        ->set('form.user_id', $user->id)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('staff.index'));

    $this->assertDatabaseHas('staff', [
        'name' => 'Staff A',
        'is_active' => false,
        'user_id' => $user->id,
    ]);
});

test('staff form filters user choices by name or email', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $matchingUser = User::factory()->create([
        'name' => 'Searchable User',
        'email' => 'searchable@example.com',
    ]);
    $otherUser = User::factory()->create([
        'name' => 'Other User',
        'email' => 'other@example.com',
    ]);

    $this->actingAs($admin);

    Livewire::test('pages::staff.create')
        ->set('userSearch', 'Searchable User')
        ->assertSee($matchingUser->name)
        ->assertDontSee($otherUser->name)
        ->set('userSearch', 'searchable@example.com')
        ->assertSee($matchingUser->name)
        ->assertDontSee($otherUser->name);
});

test('staff form creates a staff member without a linked user', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.create')
        ->set('form.name', 'Unlinked Staff')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('staff.index'));

    $this->assertDatabaseHas('staff', ['name' => 'Unlinked Staff', 'user_id' => null]);
});

test('staff form rejects a user already assigned to another staff member', function () {
    $user = User::factory()->create();
    Staff::factory()->create(['user_id' => $user->id]);

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.create')
        ->set('form.name', 'Second Staff')
        ->set('form.user_id', $user->id)
        ->call('save')
        ->assertHasErrors(['form.user_id' => 'unique']);

    $this->assertDatabaseCount('staff', 1);
    $this->assertDatabaseMissing('staff', ['name' => 'Second Staff']);
});

test('staff form allows reusing a user from a trashed staff member', function () {
    $user = User::factory()->create();
    $trashed = Staff::factory()->create(['name' => 'Old Staff', 'user_id' => $user->id]);
    $trashed->delete();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.create')
        ->set('form.name', 'New Staff')
        ->set('form.user_id', $user->id)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('staff.index'));

    $this->assertDatabaseHas('staff', ['name' => 'New Staff', 'user_id' => $user->id]);
});
