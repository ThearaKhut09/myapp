<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        $institutions = [
            [
                'name' => 'Harvard University',
                'description' => 'Harvard University is a private Ivy League research university in Cambridge, Massachusetts.',
                'address' => '86 Brattle Street',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02138',
                'email' => 'admissions@harvard.edu',
                'phone' => '+1-617-495-1000',
                'website' => 'https://www.harvard.edu',
                'type' => 'university',
            ],
            [
                'name' => 'Stanford University',
                'description' => 'Stanford University is a private research university located in Stanford, California.',
                'address' => '450 Jane Stanford Way',
                'city' => 'Stanford',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '94305',
                'email' => 'admission@stanford.edu',
                'phone' => '+1-650-723-2300',
                'website' => 'https://www.stanford.edu',
                'type' => 'university',
            ],
            [
                'name' => 'MIT',
                'description' => 'Massachusetts Institute of Technology is a private research university in Cambridge, Massachusetts.',
                'address' => '77 Massachusetts Avenue',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02139',
                'email' => 'admissions@mit.edu',
                'phone' => '+1-617-253-1000',
                'website' => 'https://www.mit.edu',
                'type' => 'university',
            ],
            [
                'name' => 'Tech Academy',
                'description' => 'A modern technology-focused educational institution offering cutting-edge programs.',
                'address' => '123 Innovation Drive',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '94105',
                'email' => 'info@techacademy.edu',
                'phone' => '+1-415-555-0123',
                'website' => 'https://www.techacademy.edu',
                'type' => 'institute',
            ],
            [
                'name' => 'Community College Central',
                'description' => 'A comprehensive community college serving diverse educational needs.',
                'address' => '456 Education Blvd',
                'city' => 'Austin',
                'state' => 'TX',
                'country' => 'USA',
                'postal_code' => '78701',
                'email' => 'admissions@cccentral.edu',
                'phone' => '+1-512-555-0456',
                'website' => 'https://www.cccentral.edu',
                'type' => 'college',
            ]
        ];

        foreach ($institutions as $institution) {
            Institution::create($institution);
        }
    }
}
