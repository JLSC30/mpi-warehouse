<?php

use App\Models\Staff;
use App\Models\User;
use App\Policies\StaffPolicy;

/**
 * Ensure every staff policy ability grants access to admins and denies it to regular users.
 */
test('only admins are authorized for staff policy abilities', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $normalUser = User::factory()->create();
    $staff = Staff::factory()->make();
    $policy = new StaffPolicy;

    $abilities = [
        'viewAny' => [],
        'view' => [$staff],
        'create' => [],
        'update' => [$staff],
        'delete' => [$staff],
        'restore' => [$staff],
        'forceDelete' => [$staff],
    ];

    foreach ($abilities as $ability => $arguments) {
        expect($policy->{$ability}($admin, ...$arguments))->toBeTrue();
        expect($policy->{$ability}($normalUser, ...$arguments))->toBeFalse();
    }
});

/**
 * Ensure regular users are denied access to the staff list route.
 */
test('normal users cannot visit the staff page', function () {
    $normalUser = User::factory()->create();

    $this->actingAs($normalUser)
        ->get(route('staff.index'))
        ->assertForbidden();
});

test('guests are redirected to login from the staff page', function () {
    $this->get(route('staff.index'))
        ->assertRedirect(route('login'));
});

test('normal users cannot access staff creation, editing, or trash pages', function () {
    $normalUser = User::factory()->create();
    $staff = Staff::factory()->create();

    $this->actingAs($normalUser);

    $this->get(route('staff.create'))->assertForbidden();
    $this->get(route('staff.edit', $staff))->assertForbidden();
    $this->get(route('staff.trash'))->assertForbidden();
});

/**
 * Ensure admins can access the staff list route.
 */
test('admins can visit the staff page', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('staff.index'))
        ->assertOk();
});

test('admins can access staff creation, editing, and trash pages', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $staff = Staff::factory()->create();

    $this->actingAs($admin);

    $this->get(route('staff.create'))
        ->assertOk()
        ->assertSee('New Staff')
        ->assertSee('Name');

    $this->get(route('staff.edit', $staff))
        ->assertOk()
        ->assertSee('Edit '.$staff->name);

    $this->get(route('staff.trash'))
        ->assertOk()
        ->assertSee('Trash');
});
