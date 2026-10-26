<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class LocalDemoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            throw new RuntimeException('The demo seeder can only run in the local environment.');
        }

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

        Supplier::factory()->count(10)->create();
    }
}
