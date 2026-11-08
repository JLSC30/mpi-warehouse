<?php

use App\Models\Staff;
use App\Models\User;

test('staff show page displays staff details and assigned user', function () {
    $assignedUser = User::factory()->create([
        'name' => 'Assigned User',
        'email' => 'assigned@example.com',
    ]);
    $staff = Staff::factory()->inactive()->create([
        'name' => 'Staff A',
        'user_id' => $assignedUser->id,
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staff.show', $staff))
        ->assertOk()
        ->assertSee('Staff A')
        ->assertSee('Inactive')
        ->assertSee('Assigned User')
        ->assertSee('assigned@example.com');
});

test('staff show page handles an unassigned user', function () {
    $staff = Staff::factory()->create([
        'name' => 'Unassigned Staff',
        'user_id' => null,
    ]);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staff.show', $staff))
        ->assertOk()
        ->assertSee('No user assigned');
});
