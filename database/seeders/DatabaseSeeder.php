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
        User::factory()->create([
            'first_name' => 'Carlos',
            'last_name' => 'Vertiz',
            'email' => 'carlos@vertiz.net',
            'password' => bcrypt('carlos123'),
        ]);

        $this->call(JobSeeder::class);
    }
}
