<?php

use App\Models\Staff;
use App\Models\User;

test('staff list shows the total number of staff across pages', function () {
    Staff::factory()->count(20)->create();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staffs.index'))
        ->assertOk()
        ->assertSee('20 staffs');
});

test('staff search matches names', function () {
    Staff::factory()->create(['name' => 'Needle Staff']);
    Staff::factory()->create(['name' => 'Other Staff']);

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staffs.index', ['search' => 'Needle']))
        ->assertOk()
        ->assertSee('Needle Staff')
        ->assertDontSee('Other Staff');
});

test('staff list does not show staff in the trash', function () {
    $staff = Staff::factory()->create(['name' => 'Deleted Staff']);
    $staff->delete();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staffs.index'))
        ->assertOk()
        ->assertDontSee('Deleted Staff')
        ->assertSee('No staffs found.');
});
