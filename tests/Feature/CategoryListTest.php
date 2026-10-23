<?php

use App\Models\Category;
use App\Models\User;

test('category list shows the total number of categories across pages', function () {
    Category::factory()->count(20)->create();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('categories.index'))
        ->assertOk()
        ->assertSee('20 categories');
});

test('category search matches names and codes', function () {
    Category::factory()->create([
        'code' => 'FRUIT-01',
        'name' => 'Needle fruit',
    ]);
    Category::factory()->create([
        'code' => 'NEEDLE-02',
        'name' => 'Office supplies',
    ]);
    Category::factory()->create([
        'code' => 'OTHER-03',
        'name' => 'Other category',
    ]);

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('categories.index', ['search' => 'needle']))
        ->assertOk()
        ->assertSee('Needle fruit')
        ->assertSee('Office supplies')
        ->assertDontSee('Other category');
});
