<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\Institution;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = Institution::all();
          $instructors = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@harvard.edu',
                'phone' => '+1-617-495-1001',
                'department' => 'Computer Science',
                'title' => 'Professor',
                'bio' => 'Expert in Artificial Intelligence and Machine Learning with over 15 years of experience.',
                'specialization' => 'Artificial Intelligence',
                'hire_date' => '2018-08-15',
                'salary' => 120000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Harvard University')->first()->id ?? 1,
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@stanford.edu',
                'phone' => '+1-650-723-2301',
                'department' => 'Mathematics',
                'title' => 'Associate Professor',
                'bio' => 'Specialist in advanced statistics and data analysis.',
                'specialization' => 'Statistics',
                'hire_date' => '2017-01-10',
                'salary' => 115000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Stanford University')->first()->id ?? 2,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@mit.edu',
                'phone' => '+1-617-253-1001',
                'department' => 'Engineering',
                'title' => 'Assistant Professor',
                'bio' => 'Software engineering expert with industry and academic experience.',
                'specialization' => 'Software Engineering',
                'hire_date' => '2019-09-01',
                'salary' => 125000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'MIT')->first()->id ?? 3,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Rodriguez',
                'email' => 'emily.rodriguez@techacademy.edu',
                'phone' => '+1-415-555-0124',
                'department' => 'Web Development',
                'title' => 'Senior Instructor',
                'bio' => 'Frontend development specialist with expertise in modern frameworks.',
                'specialization' => 'Frontend Development',
                'hire_date' => '2020-03-15',
                'salary' => 95000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Tech Academy')->first()->id ?? 4,
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Wilson',
                'email' => 'david.wilson@cccentral.edu',
                'phone' => '+1-512-555-0457',
                'department' => 'Business',
                'title' => 'Lecturer',
                'bio' => 'Marketing professional with extensive industry experience.',
                'specialization' => 'Marketing',
                'hire_date' => '2016-06-20',
                'salary' => 80000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Community College Central')->first()->id ?? 5,
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Thompson',
                'email' => 'lisa.thompson@harvard.edu',
                'phone' => '+1-617-495-1002',
                'department' => 'Psychology',
                'title' => 'Associate Professor',
                'bio' => 'Cognitive psychology researcher with focus on learning and memory.',
                'specialization' => 'Cognitive Psychology',
                'hire_date' => '2015-08-30',
                'salary' => 110000.00,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Harvard University')->first()->id ?? 1,
            ]
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}
