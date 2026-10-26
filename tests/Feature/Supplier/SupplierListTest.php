<?php

use App\Models\Supplier;
use App\Models\User;

test('supplier list shows the total number of supplier across pages', function () {
    Supplier::factory()->count(20)->create();

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('suppliers.index'))
        ->assertOk()
        ->assertSee('20 supplier');
});

test('supplier search matches names', function () {
    Supplier::factory()->create([
        'name' => 'Supplier A',
    ]);
    Supplier::factory()->create([
        'name' => 'Supplier B',
    ]);
    Supplier::factory()->create([
        'name' => 'Supplier C',
    ]);

    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('suppliers.index', ['search' => 'Supplier']))
        ->assertOk()
        ->assertSee('Supplier A')
        ->assertSee('Supplier B')
        ->assertDontSee('Supplier D');
});

test('suppliers list does not show categories in the trash', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Deleted supplier',
    ]);
    $supplier->delete();
    $admin = User::factory()->create();
    $admin->forceFill(['is_admin' => true])->save();

    $this->actingAs($admin)
        ->get(route('suppliers.index'))
        ->assertOk()
        ->assertDontSee('Deleted supplier')
        ->assertSee('No supplier found');
});
