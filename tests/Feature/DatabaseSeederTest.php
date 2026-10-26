<?php

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\LocalDemoSeeder;

test('database seeding rejects demo accounts outside the local environment', function () {
    expect(fn () => app(DatabaseSeeder::class)->run())
        ->toThrow(RuntimeException::class, 'The demo seeder can only run in the local environment.');

    $this->assertDatabaseMissing('users', ['email' => 'admin@warehouse.test']);
});

test('the local demo seeder rejects direct use outside the local environment', function () {
    expect(fn () => app(LocalDemoSeeder::class)->run())
        ->toThrow(RuntimeException::class, 'The demo seeder can only run in the local environment.');

    $this->assertDatabaseMissing('users', ['email' => 'admin@warehouse.test']);
});

test('the demo seeder creates the administrator in the local environment', function () {
    app()->detectEnvironment(fn () => 'local');

    app(DatabaseSeeder::class)->run();

    $this->assertDatabaseHas('users', [
        'email' => 'admin@warehouse.test',
        'is_admin' => true,
    ]);
});
