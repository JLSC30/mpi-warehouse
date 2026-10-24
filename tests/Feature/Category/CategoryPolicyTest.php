<?php

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;

/**
 * Ensure every category policy ability grants access to admins and denies it to regular users.
 */
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

/**
 * Ensure regular users are denied access to the category list route.
 */
test('normal users cannot visit the category page', function () {
    $normalUser = User::factory()->create();

    $this->actingAs($normalUser)
        ->get(route('categories.index'))
        ->assertForbidden();
});

test('guests are redirected to login from the category page', function () {
    $this->get(route('categories.index'))
        ->assertRedirect(route('login'));
});

test('normal users cannot access category creation, editing, or trash pages', function () {
    $normalUser = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($normalUser);

    $this->get(route('categories.create'))->assertForbidden();
    $this->get(route('categories.edit', $category))->assertForbidden();
    $this->get(route('categories.trash'))->assertForbidden();
});

/**
 * Ensure admins can access the category list route.
 */
test('admins can visit the category page', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('categories.index'))
        ->assertOk();
});

test('admins can access category creation, editing, and trash pages', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();
    $category = Category::factory()->create();

    $this->actingAs($admin);

    $this->get(route('categories.create'))
        ->assertOk()
        ->assertSee('New Category')
        ->assertSee('Name')
        ->assertSee('Code');

    $this->get(route('categories.edit', $category))
        ->assertOk()
        ->assertSee('Edit '.$category->name);

    $this->get(route('categories.trash'))
        ->assertOk()
        ->assertSee('Trash');
});
