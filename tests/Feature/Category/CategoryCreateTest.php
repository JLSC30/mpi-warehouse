<?php

use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

/**
 * Ensure required validation errors prevent an empty category from being persisted.
 */
test('category form does not create a category when required fields are empty', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
            'form.code' => 'required',
        ])
        ->assertSee('The name field is required.')
        ->assertSee('The code field is required.');

    $this->assertDatabaseCount('categories', 0);
});

/**
 * Ensure valid form data is saved and the user is redirected to the category list.
 */
test('category form creates a category with valid data', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->set('form.name', 'Tools')
        ->set('form.code', 'TOOLS')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', [
        'name' => 'Tools',
        'code' => 'TOOLS',
    ]);
});

test('category form accepts the maximum field lengths and supported code punctuation', function () {
    $name = str_repeat('N', 32);
    $code = 'CAT_1234-ABCDXYZ';
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->set('form.name', $name)
        ->set('form.code', $code)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('categories', [
        'name' => $name,
        'code' => $code,
    ]);
});

test('category form rejects codes with unsupported characters and shows the custom message', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->set('form.name', 'Tools')
        ->set('form.code', 'TOOLS!')
        ->call('save')
        ->assertHasErrors(['form.code' => 'alpha_dash'])
        ->assertSee('The code may only contain letters, numbers, dashes and underscores.');

    $this->assertDatabaseCount('categories', 0);
});

test('category form enforces maximum field lengths', function (string $field, string $value, string $errorField, string $message) {
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->set('form.name', 'Tools')
        ->set('form.code', 'TOOLS')
        ->set($field, $value)
        ->call('save')
        ->assertHasErrors([$errorField => 'max'])
        ->assertSee($message);

    $this->assertDatabaseCount('categories', 0);
})->with([
    'names longer than 32 characters' => [
        'form.name',
        str_repeat('N', 33),
        'form.name',
        'The name field must not be greater than 32 characters.',
    ],
    'codes longer than 16 characters' => [
        'form.code',
        str_repeat('C', 17),
        'form.code',
        'The code field must not be greater than 16 characters.',
    ],
]);

test('category form rejects a code already assigned to another category', function () {
    Category::factory()->create(['code' => 'TOOLS']);
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin);

    Livewire::test('pages::category.create')
        ->set('form.name', 'Hardware')
        ->set('form.code', 'TOOLS')
        ->call('save')
        ->assertHasErrors(['form.code' => 'unique'])
        ->assertSee('The code has already been taken.');

    $this->assertDatabaseCount('categories', 1);
});
