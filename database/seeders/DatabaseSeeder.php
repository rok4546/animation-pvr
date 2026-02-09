<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run admin user seeder first
        $this->call(AdminUserSeeder::class);

        // Run category and product seeder
        $this->call(CategoryProductSeeder::class);
    }
}
