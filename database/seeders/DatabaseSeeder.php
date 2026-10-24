<?php

namespace Database\Seeders;

use App\Models\Category;
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
            User::factory()->raw([
                'name' => 'Admin User',
                'email' => 'admin@warehouse.test',
            ]),
        );
        $adminUser->forceFill(['name' => 'Admin User', 'is_admin' => true])->save();

        $normalUser = User::query()->firstOrCreate(
            ['email' => 'user@warehouse.test'],
            User::factory()->raw([
                'name' => 'Normal User',
                'email' => 'user@warehouse.test',
            ]),
        );
        $normalUser->forceFill(['name' => 'Normal User', 'is_admin' => false])->save();

        Category::factory()->count(20)->create();
    }
}
