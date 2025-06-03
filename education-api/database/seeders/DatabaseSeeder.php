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
        // Create a test user manually without using factory
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        // Run all education-related seeders
        $this->call([
            InstitutionSeeder::class,
            InstructorSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            EnrollmentSeeder::class,
        ]);

        $this->command->info('Education API database seeded successfully!');
    }
}
