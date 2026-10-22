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
