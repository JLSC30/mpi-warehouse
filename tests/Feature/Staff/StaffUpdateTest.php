<?php

use App\Models\Staff;
use App\Models\User;
use Livewire\Livewire;

test('staff edit page loads and updates the staff fields', function () {
    $assignedUser = User::factory()->create();
    $newUser = User::factory()->create();
    $staff = Staff::factory()->create([
        'name' => 'Original Staff',
        'is_active' => true,
        'user_id' => $assignedUser->id,
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    $this->get(route('staff.edit', $staff))->assertOk();

    Livewire::test('pages::staff.edit', ['staff' => $staff])
        ->assertSet('form.name', 'Original Staff')
        ->assertSet('form.is_active', true)
        ->assertSet('form.user_id', $assignedUser->id)
        ->set('form.name', 'Updated Staff')
        ->set('form.is_active', false)
        ->set('form.user_id', $newUser->id)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('staff.index'));

    $this->assertDatabaseHas('staff', [
        'id' => $staff->id,
        'name' => 'Updated Staff',
        'is_active' => false,
        'user_id' => $newUser->id,
    ]);
});

test('staff edit page filters user choices by name or email', function () {
    $staff = Staff::factory()->create();
    $matchingUser = User::factory()->create([
        'name' => 'Searchable User',
        'email' => 'searchable@example.com',
    ]);
    $otherUser = User::factory()->create([
        'name' => 'Other User',
        'email' => 'other@example.com',
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.edit', ['staff' => $staff])
        ->set('userSearch', 'Searchable User')
        ->assertSee($matchingUser->name)
        ->assertDontSee($otherUser->name)
        ->set('userSearch', 'searchable@example.com')
        ->assertSee($matchingUser->name)
        ->assertDontSee($otherUser->name);
});
