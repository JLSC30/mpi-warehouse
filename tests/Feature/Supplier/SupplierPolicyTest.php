<?php

use App\Models\Supplier;
use App\Models\User;
use App\Policies\SupplierPolicy;

test('only admins are authorized for supplier policy abilities', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $normalUser = User::factory()->create();
    $supplier = Supplier::factory()->make();
    $policy = new SupplierPolicy;

    $abilities = [
        'viewAny' => [],
        'view' => [$supplier],
        'create' => [],
        'update' => [$supplier],
        'delete' => [$supplier],
        'restore' => [$supplier],
        'forceDelete' => [$supplier],
    ];

    foreach ($abilities as $ability => $arguments) {
        expect($policy->{$ability}($admin, ...$arguments))->toBeTrue();
        expect($policy->{$ability}($normalUser, ...$arguments))->toBeFalse();
    }
});

test('normal users cannot visit the supplier page', function () {
    $normalUser = User::factory()->create();

    $this->actingAs($normalUser)
        ->get(route('suppliers.index'))
        ->assertForbidden();
});

test('guests are redirected to login from the supplier page', function () {
    $this->get(route('suppliers.index'))
        ->assertRedirect(route('login'));
});

test('normal users cannot access supplier creation, editing, or trash pages', function () {
    $normalUser = User::factory()->create();
    $supplier = Supplier::factory()->create();

    $this->actingAs($normalUser);

    $this->get(route('suppliers.create'))->assertForbidden();
    $this->get(route('suppliers.edit', $supplier))->assertForbidden();
    $this->get(route('suppliers.trash'))->assertForbidden();
});

test('admins can visit the supplier page', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('suppliers.index'))
        ->assertOk();
});

test('admins can access supplier creation, editing, and trash pages', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $supplier = Supplier::factory()->create();

    $this->actingAs($admin);

    $this->get(route('suppliers.create'))
        ->assertOk()
        ->assertSee('New Supplier')
        ->assertSee('Name');

    $this->get(route('suppliers.edit', $supplier))
        ->assertOk()
        ->assertSee('Edit '.$supplier->name);

    $this->get(route('suppliers.trash'))
        ->assertOk()
        ->assertSee('Trash');
});
