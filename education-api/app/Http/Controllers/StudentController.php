<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index(Request $request): JsonResponse
    {
        // Mock data for testing without database
        $students = [
            [
                'id' => 1,
                'student_id' => 'STU2025001',
                'first_name' => 'Alice',
                'last_name' => 'Anderson',
                'email' => 'alice.anderson@email.com',
                'phone' => '+1-555-0101',
                'date_of_birth' => '2000-03-15',
                'gender' => 'female',
                'address' => '123 Main St',
                'city' => 'Boston',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02101',
                'emergency_contact' => 'Jane Anderson',
                'emergency_phone' => '+1-555-0102',
                'enrollment_date' => '2025-01-10',
                'status' => 'active',
                'created_at' => '2025-01-10T00:00:00Z',
                'updated_at' => '2025-01-10T00:00:00Z'
            ],
            [
                'id' => 2,
                'student_id' => 'STU2025002',
                'first_name' => 'Bob',
                'last_name' => 'Wilson',
                'email' => 'bob.wilson@email.com',
                'phone' => '+1-555-0201',
                'date_of_birth' => '1999-07-22',
                'gender' => 'male',
                'address' => '456 Oak Ave',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02139',
                'emergency_contact' => 'Mary Wilson',
                'emergency_phone' => '+1-555-0202',
                'enrollment_date' => '2025-01-15',
                'status' => 'active',
                'created_at' => '2025-01-15T00:00:00Z',
                'updated_at' => '2025-01-15T00:00:00Z'
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $students,
            'total' => count($students),
            'page' => 1,
            'per_page' => 10
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'required|date|before:today',
                'gender' => 'nullable|in:male,female,other',
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'emergency_contact' => 'nullable|string|max:255',
                'emergency_phone' => 'nullable|string|max:20',
                'enrollment_date' => 'required|date',
                'status' => 'in:active,inactive,graduated,suspended'
            ]);

            // Generate unique student ID
            $validated['student_id'] = $this->generateStudentId();

            // Mock response for testing without database
            $student = array_merge($validated, [
                'id' => rand(1000, 9999),
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString()
            ]);            return response()->json([
                'status' => 'success',
                'message' => 'Student created successfully',
                'data' => $student
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        // Mock data for testing without database
        $students = [
            1 => [
                'id' => 1,
                'student_id' => 'STU2025001',
                'first_name' => 'Alice',
                'last_name' => 'Anderson',
                'email' => 'alice.anderson@email.com',
                'phone' => '+1-555-0101',
                'date_of_birth' => '2000-03-15',
                'gender' => 'female',
                'address' => '123 Main St',
                'city' => 'Boston',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02101',
                'emergency_contact' => 'Jane Anderson',
                'emergency_phone' => '+1-555-0102',
                'enrollment_date' => '2025-01-10',
                'status' => 'active',
                'created_at' => '2025-01-10T00:00:00Z',
                'updated_at' => '2025-01-10T00:00:00Z',
                'enrollments' => [
                    [
                        'id' => 1,
                        'enrollment_date' => '2025-01-10',
                        'status' => 'enrolled',
                        'grade' => null,
                        'course' => [
                            'id' => 1,
                            'title' => 'Introduction to Computer Science',
                            'code' => 'CS101',
                            'description' => 'Fundamentals of programming and computer science concepts',
                            'credits' => 3,
                            'institution' => [
                                'id' => 1,
                                'name' => 'MIT',
                                'type' => 'university'
                            ],
                            'instructor' => [
                                'id' => 1,
                                'first_name' => 'Dr. Sarah',
                                'last_name' => 'Johnson'
                            ]
                        ]
                    ]
                ]
            ],
            2 => [
                'id' => 2,
                'student_id' => 'STU2025002',
                'first_name' => 'Bob',
                'last_name' => 'Wilson',
                'email' => 'bob.wilson@email.com',
                'phone' => '+1-555-0201',
                'date_of_birth' => '1999-07-22',
                'gender' => 'male',
                'address' => '456 Oak Ave',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02139',
                'emergency_contact' => 'Mary Wilson',
                'emergency_phone' => '+1-555-0202',
                'enrollment_date' => '2025-01-15',
                'status' => 'active',
                'created_at' => '2025-01-15T00:00:00Z',
                'updated_at' => '2025-01-15T00:00:00Z',
                'enrollments' => []
            ]
        ];

        if (!isset($students[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $students[$id]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:students,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'sometimes|date|before:today',
                'gender' => 'nullable|in:male,female,other',
                'address' => 'sometimes|string',
                'city' => 'sometimes|string|max:255',
                'state' => 'sometimes|string|max:255',
                'country' => 'sometimes|string|max:255',
                'postal_code' => 'sometimes|string|max:10',
                'emergency_contact' => 'nullable|string|max:255',
                'emergency_phone' => 'nullable|string|max:20',
                'enrollment_date' => 'sometimes|date',
                'status' => 'sometimes|in:active,inactive,graduated,suspended'
            ]);

            $student->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'data' => $student
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
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        // Check if student has active enrollments
        $activeEnrollments = $student->enrollments()->where('status', 'enrolled')->count();
        
        if ($activeEnrollments > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete student with active enrollments'
            ], 400);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }    /**
     * Generate unique student ID
     */
    private function generateStudentId(): string
    {
        // Mock implementation for testing without database
        return 'STU' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get student's course enrollments
     */
    public function enrollments(string $id): JsonResponse
    {
        $student = Student::with(['enrollments.course.instructor', 'enrollments.course.institution'])->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $student->enrollments
        ]);
    }
}
