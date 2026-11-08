<?php

use App\Models\User;
use Livewire\Livewire;

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
        ->assertRedirect(route('staffs.index'));

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
