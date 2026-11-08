<?php

use App\Models\Staff;
use App\Models\User;
use Livewire\Livewire;

test('admins can restore a trashed staff member', function () {
    $staff = Staff::factory()->create();
    $staff->delete();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.trash')
        ->call('restore', $staff->id);

    $this->assertDatabaseHas('staff', [
        'id' => $staff->id,
        'deleted_at' => null,
    ]);
});

test('admins can permanently delete a trashed staff member', function () {
    $staff = Staff::factory()->create();
    $staff->delete();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::staff.trash')
        ->set('deletingId', $staff->id)
        ->call('forceDelete')
        ->assertSet('deletingId', null);

    $this->assertDatabaseMissing('staff', ['id' => $staff->id]);
});
