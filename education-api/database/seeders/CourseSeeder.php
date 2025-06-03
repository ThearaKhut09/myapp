<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Instructor;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = Institution::all();
        $instructors = Instructor::all();
          $courses = [
            [
                'title' => 'Introduction to Computer Science',
                'course_code' => 'CS101',
                'description' => 'Fundamental concepts of computer science including programming, algorithms, and data structures.',
                'credits' => 4,
                'category' => 'Computer Science',
                'level' => 'Beginner',
                'duration_weeks' => 16,
                'price' => 2500.00,
                'max_students' => 100,
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-10',
                'schedule' => 'Monday, Wednesday, Friday 10:00-11:30',
                'location' => 'Science Building Room 101',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Harvard University')->first()->id ?? 1,
                'instructor_id' => $instructors->where('specialization', 'Artificial Intelligence')->first()->id ?? 1,
            ],
            [
                'title' => 'Advanced Statistics',
                'course_code' => 'STAT301',
                'description' => 'Advanced statistical methods and their applications in research and industry.',
                'credits' => 3,
                'category' => 'Mathematics',
                'level' => 'Advanced',
                'duration_weeks' => 16,
                'price' => 3000.00,
                'max_students' => 50,
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-10',
                'schedule' => 'Tuesday, Thursday 14:00-15:30',
                'location' => 'Mathematics Building Room 205',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Stanford University')->first()->id ?? 2,
                'instructor_id' => $instructors->where('specialization', 'Statistics')->first()->id ?? 2,
            ],
            [
                'title' => 'Software Engineering Principles',
                'course_code' => 'SE201',
                'description' => 'Principles and practices of software engineering including design patterns and project management.',
                'credits' => 4,
                'category' => 'Engineering',
                'level' => 'Intermediate',
                'duration_weeks' => 16,
                'price' => 3500.00,
                'max_students' => 75,
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-10',
                'schedule' => 'Monday, Wednesday 13:00-14:30',
                'location' => 'Engineering Lab 3',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'MIT')->first()->id ?? 3,
                'instructor_id' => $instructors->where('specialization', 'Software Engineering')->first()->id ?? 3,
            ],
            [
                'title' => 'Frontend Web Development',
                'course_code' => 'WEB101',
                'description' => 'Modern frontend development using HTML, CSS, JavaScript, and popular frameworks.',
                'credits' => 3,
                'category' => 'Web Development',
                'level' => 'Beginner',
                'duration_weeks' => 12,
                'price' => 1800.00,
                'max_students' => 40,
                'start_date' => '2025-02-01',
                'end_date' => '2025-05-01',
                'schedule' => 'Monday through Friday 9:00-12:00',
                'location' => 'Tech Lab A',
                'is_online' => true,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Tech Academy')->first()->id ?? 4,
                'instructor_id' => $instructors->where('specialization', 'Frontend Development')->first()->id ?? 4,
            ],
            [
                'title' => 'Digital Marketing Fundamentals',
                'course_code' => 'MKT101',
                'description' => 'Introduction to digital marketing strategies, social media, and online advertising.',
                'credits' => 2,
                'category' => 'Business',
                'level' => 'Beginner',
                'duration_weeks' => 8,
                'price' => 1200.00,
                'max_students' => 60,
                'start_date' => '2025-02-15',
                'end_date' => '2025-04-15',
                'schedule' => 'Saturday 9:00-13:00',
                'location' => 'Business Center Room 12',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Community College Central')->first()->id ?? 5,
                'instructor_id' => $instructors->where('specialization', 'Marketing')->first()->id ?? 5,
            ],
            [
                'title' => 'Cognitive Psychology Research',
                'course_code' => 'PSY301',
                'description' => 'Advanced research methods in cognitive psychology and experimental design.',
                'credits' => 4,
                'category' => 'Psychology',
                'level' => 'Advanced',
                'duration_weeks' => 16,
                'price' => 2800.00,
                'max_students' => 30,
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-10',
                'schedule' => 'Tuesday, Thursday 10:00-11:30',
                'location' => 'Psychology Research Lab',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'Harvard University')->first()->id ?? 1,
                'instructor_id' => $instructors->where('specialization', 'Cognitive Psychology')->first()->id ?? 6,
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'course_code' => 'CS201',
                'description' => 'Advanced data structures, algorithm design, and complexity analysis.',
                'credits' => 4,
                'category' => 'Computer Science',
                'level' => 'Intermediate',
                'duration_weeks' => 16,
                'price' => 2700.00,
                'max_students' => 80,
                'start_date' => '2025-01-15',
                'end_date' => '2025-05-10',
                'schedule' => 'Monday, Wednesday, Friday 15:00-16:30',
                'location' => 'Computer Lab 2',
                'is_online' => false,
                'is_active' => true,
                'institution_id' => $institutions->where('name', 'MIT')->first()->id ?? 3,
                'instructor_id' => $instructors->where('specialization', 'Software Engineering')->first()->id ?? 3,
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
