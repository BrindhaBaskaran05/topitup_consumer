<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Brindha',
            'last_name' => 'B',
            'email' => 'brindha@example.com',
            'mobile' => '9876543210',
            'password' => 'password',
            'status' => true,
        ]);
    }
}