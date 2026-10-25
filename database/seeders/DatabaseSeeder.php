<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::query()->firstOrCreate(
            ['email' => 'admin@warehouse.test'],
            User::factory()->make([
                'name' => 'Admin User',
                'email' => 'admin@warehouse.test',
            ])->getAttributes(),
        );
        $adminUser->forceFill([
            'name' => 'Admin User',
            'email_verified_at' => now(),
            'is_admin' => true,
        ])->save();

        $normalUser = User::query()->firstOrCreate(
            ['email' => 'user@warehouse.test'],
            User::factory()->make([
                'name' => 'Normal User',
                'email' => 'user@warehouse.test',
            ])->getAttributes(),
        );
        $normalUser->forceFill([
            'name' => 'Normal User',
            'email_verified_at' => now(),
            'is_admin' => false,
        ])->save();

        Category::factory()->count(20)->create();

        Location::factory()->count(10)->create();
    }
}
