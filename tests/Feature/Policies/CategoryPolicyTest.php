<?php

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;

test('only admins are authorized for category policy abilities', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $normalUser = User::factory()->create();
    $category = Category::factory()->make();
    $policy = new CategoryPolicy;

    $abilities = [
        'viewAny' => [],
        'view' => [$category],
        'create' => [],
        'update' => [$category],
        'delete' => [$category],
        'restore' => [$category],
        'forceDelete' => [$category],
    ];

    foreach ($abilities as $ability => $arguments) {
        expect($policy->{$ability}($admin, ...$arguments))->toBeTrue();
        expect($policy->{$ability}($normalUser, ...$arguments))->toBeFalse();
    }
});

test('normal users cannot visit the category page', function () {
    $normalUser = User::factory()->create();

    $this->actingAs($normalUser)
        ->get(route('categories.index'))
        ->assertForbidden();
});

test('admins can visit the category page', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('categories.index'))
        ->assertOk();
});
