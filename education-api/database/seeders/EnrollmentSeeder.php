<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();
        
        // Create various enrollment scenarios
        $enrollments = [
            // Student 1 enrollments
            [
                'student_id' => $students->first()->id ?? 1,
                'course_id' => $courses->where('code', 'CS101')->first()->id ?? 1,
                'enrollment_date' => '2025-01-10',
                'grade' => 'A',
                'grade_points' => 4.0,
                'attendance_percentage' => 95.5,
                'payment_status' => 'paid',
                'payment_amount' => 2500.00,
                'payment_date' => '2025-01-05',
                'status' => 'active',
            ],
            [
                'student_id' => $students->first()->id ?? 1,
                'course_id' => $courses->where('code', 'PSY301')->first()->id ?? 6,
                'enrollment_date' => '2025-01-10',
                'grade' => 'B+',
                'grade_points' => 3.3,
                'attendance_percentage' => 88.0,
                'payment_status' => 'paid',
                'payment_amount' => 2800.00,
                'payment_date' => '2025-01-05',
                'status' => 'active',
            ],
            // Student 2 enrollments
            [
                'student_id' => $students->skip(1)->first()->id ?? 2,
                'course_id' => $courses->where('code', 'STAT301')->first()->id ?? 2,
                'enrollment_date' => '2025-01-12',
                'grade' => 'A-',
                'grade_points' => 3.7,
                'attendance_percentage' => 92.0,
                'payment_status' => 'paid',
                'payment_amount' => 3000.00,
                'payment_date' => '2025-01-08',
                'status' => 'active',
            ],
            [
                'student_id' => $students->skip(1)->first()->id ?? 2,
                'course_id' => $courses->where('code', 'CS201')->first()->id ?? 7,
                'enrollment_date' => '2025-01-12',
                'grade' => 'B',
                'grade_points' => 3.0,
                'attendance_percentage' => 85.5,
                'payment_status' => 'paid',
                'payment_amount' => 2700.00,
                'payment_date' => '2025-01-08',
                'status' => 'active',
            ],
            // Student 3 enrollments
            [
                'student_id' => $students->skip(2)->first()->id ?? 3,
                'course_id' => $courses->where('code', 'SE201')->first()->id ?? 3,
                'enrollment_date' => '2025-01-14',
                'grade' => null,
                'grade_points' => null,
                'attendance_percentage' => 78.0,
                'payment_status' => 'paid',
                'payment_amount' => 3500.00,
                'payment_date' => '2025-01-10',
                'status' => 'active',
            ],
            // Student 4 enrollments
            [
                'student_id' => $students->skip(3)->first()->id ?? 4,
                'course_id' => $courses->where('code', 'WEB101')->first()->id ?? 4,
                'enrollment_date' => '2025-01-28',
                'grade' => null,
                'grade_points' => null,
                'attendance_percentage' => 90.0,
                'payment_status' => 'paid',
                'payment_amount' => 1800.00,
                'payment_date' => '2025-01-25',
                'status' => 'active',
            ],
            [
                'student_id' => $students->skip(3)->first()->id ?? 4,
                'course_id' => $courses->where('code', 'CS101')->first()->id ?? 1,
                'enrollment_date' => '2025-01-10',
                'grade' => 'B-',
                'grade_points' => 2.7,
                'attendance_percentage' => 82.5,
                'payment_status' => 'paid',
                'payment_amount' => 2500.00,
                'payment_date' => '2025-01-05',
                'status' => 'active',
            ],
            // Student 5 enrollments
            [
                'student_id' => $students->skip(4)->first()->id ?? 5,
                'course_id' => $courses->where('code', 'MKT101')->first()->id ?? 5,
                'enrollment_date' => '2025-02-10',
                'grade' => null,
                'grade_points' => null,
                'attendance_percentage' => 95.0,
                'payment_status' => 'pending',
                'payment_amount' => 0.00,
                'payment_date' => null,
                'status' => 'active',
            ],
            // Additional enrollments to populate more data
            [
                'student_id' => $students->skip(5)->first()->id ?? 6,
                'course_id' => $courses->where('code', 'CS101')->first()->id ?? 1,
                'enrollment_date' => '2025-01-15',
                'grade' => 'A',
                'grade_points' => 4.0,
                'attendance_percentage' => 97.0,
                'payment_status' => 'paid',
                'payment_amount' => 2500.00,
                'payment_date' => '2025-01-12',
                'status' => 'active',
            ],
            [
                'student_id' => $students->skip(6)->first()->id ?? 7,
                'course_id' => $courses->where('code', 'WEB101')->first()->id ?? 4,
                'enrollment_date' => '2025-01-30',
                'grade' => null,
                'grade_points' => null,
                'attendance_percentage' => 87.5,
                'payment_status' => 'paid',
                'payment_amount' => 1800.00,
                'payment_date' => '2025-01-28',
                'status' => 'active',
            ],
            [
                'student_id' => $students->skip(7)->first()->id ?? 8,
                'course_id' => $courses->where('code', 'STAT301')->first()->id ?? 2,
                'enrollment_date' => '2025-01-16',
                'grade' => 'B+',
                'grade_points' => 3.3,
                'attendance_percentage' => 89.0,
                'payment_status' => 'paid',
                'payment_amount' => 3000.00,
                'payment_date' => '2025-01-14',
                'status' => 'active',
            ],
            [
                'student_id' => $students->skip(8)->first()->id ?? 9,
                'course_id' => $courses->where('code', 'SE201')->first()->id ?? 3,
                'enrollment_date' => '2025-01-18',
                'grade' => null,
                'grade_points' => null,
                'attendance_percentage' => 91.5,
                'payment_status' => 'partial',
                'payment_amount' => 1750.00,
                'payment_date' => '2025-01-15',
                'status' => 'active',
            ]
        ];

        foreach ($enrollments as $enrollment) {
            Enrollment::create($enrollment);
        }
    }
}
