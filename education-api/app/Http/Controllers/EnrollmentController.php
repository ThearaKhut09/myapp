<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index(Request $request): JsonResponse
    {
        // Mock data for testing without database
        $enrollments = [
            [
                'id' => 1,
                'student_id' => 1,
                'course_id' => 1,
                'enrollment_date' => '2025-01-15',
                'completion_date' => null,
                'status' => 'enrolled',
                'grade' => null,
                'attendance_percentage' => 85.5,
                'payment_status' => 'paid',
                'created_at' => '2025-01-15T00:00:00Z',
                'updated_at' => '2025-01-15T00:00:00Z',
                'student' => [
                    'id' => 1,
                    'student_id' => 'STU2025001',
                    'first_name' => 'Alice',
                    'last_name' => 'Anderson',
                    'email' => 'alice.anderson@email.com'
                ],
                'course' => [
                    'id' => 1,
                    'course_code' => 'CS101',
                    'title' => 'Introduction to Computer Science',
                    'instructor' => [
                        'id' => 1,
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                        'title' => 'Professor'
                    ],
                    'institution' => [
                        'id' => 1,
                        'name' => 'Tech University',
                        'type' => 'University'
                    ]
                ]
            ],
            [
                'id' => 2,
                'student_id' => 2,
                'course_id' => 2,
                'enrollment_date' => '2025-01-20',
                'completion_date' => null,
                'status' => 'enrolled',
                'grade' => null,
                'attendance_percentage' => 92.0,
                'payment_status' => 'paid',
                'created_at' => '2025-01-20T00:00:00Z',
                'updated_at' => '2025-01-20T00:00:00Z',
                'student' => [
                    'id' => 2,
                    'student_id' => 'STU2025002',
                    'first_name' => 'Bob',
                    'last_name' => 'Wilson',
                    'email' => 'bob.wilson@email.com'
                ],
                'course' => [
                    'id' => 2,
                    'course_code' => 'MATH201',
                    'title' => 'Advanced Mathematics',
                    'instructor' => [
                        'id' => 2,
                        'first_name' => 'Jane',
                        'last_name' => 'Smith',
                        'title' => 'Associate Professor'
                    ],
                    'institution' => [
                        'id' => 1,
                        'name' => 'Tech University',
                        'type' => 'University'
                    ]
                ]
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $enrollments,
            'total' => count($enrollments),
            'page' => 1,
            'per_page' => 10
        ]);
    }    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'student_id' => 'required|integer',
                'course_id' => 'required|integer',
                'enrollment_date' => 'required|date',
                'amount_paid' => 'sometimes|numeric|min:0',
                'payment_complete' => 'boolean',
                'notes' => 'nullable|string'
            ]);            // Mock response for testing without database
            $enrollment = array_merge($validated, [
                'id' => rand(1000, 9999),
                'completion_date' => null,
                'status' => 'enrolled',
                'grade' => null,
                'attendance_percentage' => 0.0,
                'payment_status' => $validated['payment_complete'] ?? false ? 'paid' : 'pending',
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString(),
                'student' => [
                    'id' => $validated['student_id'],
                    'first_name' => 'Mock',
                    'last_name' => 'Student'
                ],
                'course' => [
                    'id' => $validated['course_id'],
                    'title' => 'Mock Course',
                    'code' => 'MOCK101'
                ]
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Enrollment created successfully',
                'data' => $enrollment
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */    public function show(string $id): JsonResponse
    {
        // Mock data for testing without database
        $enrollments = [
            1 => [
                'id' => 1,
                'enrollment_date' => '2025-01-10',
                'completion_date' => null,
                'status' => 'enrolled',
                'grade' => 85.5,
                'letter_grade' => 'B+',
                'attendance_percentage' => 95.0,
                'payment_status' => 'paid',
                'amount_paid' => 1500.00,
                'notes' => 'Excellent student with strong participation',
                'created_at' => '2025-01-10T00:00:00Z',
                'updated_at' => '2025-01-20T00:00:00Z',
                'student' => [
                    'id' => 1,
                    'student_id' => 'STU2025001',
                    'first_name' => 'Alice',
                    'last_name' => 'Anderson',
                    'email' => 'alice.anderson@email.com'
                ],
                'course' => [
                    'id' => 1,
                    'course_code' => 'CS101',
                    'title' => 'Introduction to Computer Science',
                    'credits' => 3,
                    'instructor' => [
                        'id' => 1,
                        'first_name' => 'Dr. Sarah',
                        'last_name' => 'Johnson',
                        'title' => 'Professor'
                    ],
                    'institution' => [
                        'id' => 1,
                        'name' => 'MIT',
                        'type' => 'university'
                    ]
                ]
            ],
            2 => [
                'id' => 2,
                'enrollment_date' => '2025-01-20',
                'completion_date' => null,
                'status' => 'enrolled',
                'grade' => null,
                'letter_grade' => null,
                'attendance_percentage' => 92.0,
                'payment_status' => 'paid',
                'amount_paid' => 1800.00,
                'notes' => null,
                'created_at' => '2025-01-20T00:00:00Z',
                'updated_at' => '2025-01-20T00:00:00Z',
                'student' => [
                    'id' => 2,
                    'student_id' => 'STU2025002',
                    'first_name' => 'Bob',
                    'last_name' => 'Wilson',
                    'email' => 'bob.wilson@email.com'
                ],
                'course' => [
                    'id' => 2,
                    'course_code' => 'MATH201',
                    'title' => 'Advanced Mathematics',
                    'credits' => 4,
                    'instructor' => [
                        'id' => 2,
                        'first_name' => 'Prof. Michael',
                        'last_name' => 'Brown',
                        'title' => 'Associate Professor'
                    ],
                    'institution' => [
                        'id' => 2,
                        'name' => 'Harvard University',
                        'type' => 'university'
                    ]
                ]
            ]
        ];

        if (!isset($enrollments[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Enrollment not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $enrollments[$id]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Enrollment not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'enrollment_date' => 'sometimes|date',
                'grade' => 'sometimes|numeric|min:0|max:100',
                'status' => 'sometimes|in:enrolled,completed,dropped,failed',
                'amount_paid' => 'sometimes|numeric|min:0',
                'payment_complete' => 'boolean',
                'completion_date' => 'sometimes|date|nullable',
                'notes' => 'nullable|string'
            ]);

            // Auto-calculate letter grade if numeric grade is provided
            if (isset($validated['grade'])) {
                $validated['letter_grade'] = $enrollment->calculateLetterGrade();
            }

            // Set completion date if status is completed
            if (isset($validated['status']) && $validated['status'] === 'completed' && !isset($validated['completion_date'])) {
                $validated['completion_date'] = now()->toDateString();
            }

            $enrollment->update($validated);
            $enrollment->load(['student', 'course.instructor', 'course.institution']);

            return response()->json([
                'success' => true,
                'message' => 'Enrollment updated successfully',
                'data' => $enrollment
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Enrollment not found'
            ], 404);
        }

        // Only allow deletion if enrollment is not completed
        if ($enrollment->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete completed enrollment'
            ], 400);
        }

        $enrollment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enrollment deleted successfully'
        ]);
    }

    /**
     * Update enrollment grade
     */
    public function updateGrade(Request $request, string $id): JsonResponse
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Enrollment not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'grade' => 'required|numeric|min:0|max:100'
            ]);

            $enrollment->update([
                'grade' => $validated['grade'],
                'letter_grade' => $enrollment->calculateLetterGrade()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Grade updated successfully',
                'data' => $enrollment
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
}
