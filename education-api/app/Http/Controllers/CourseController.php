<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index(Request $request): JsonResponse
    {
        // Mock data for testing without database
        $courses = [
            [
                'id' => 1,
                'course_code' => 'CS101',
                'title' => 'Introduction to Computer Science',
                'description' => 'Basic concepts of computer science and programming',
                'category' => 'Computer Science',
                'level' => 'Beginner',
                'duration_hours' => 40,
                'max_students' => 30,
                'price' => 299.99,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ],
                'instructor' => [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'title' => 'Professor'
                ]
            ],
            [
                'id' => 2,
                'course_code' => 'MATH201',
                'title' => 'Advanced Mathematics',
                'description' => 'Advanced mathematical concepts and applications',
                'category' => 'Mathematics',
                'level' => 'Intermediate',
                'duration_hours' => 60,
                'max_students' => 25,
                'price' => 399.99,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ],
                'instructor' => [
                    'id' => 2,
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'title' => 'Associate Professor'
                ]
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $courses,
            'total' => count($courses),
            'page' => 1,
            'per_page' => 10
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'institution_id' => 'required|integer',
                'instructor_id' => 'required|integer',
                'course_code' => 'required|string',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string|max:255',
                'level' => 'required|in:Beginner,Intermediate,Advanced',
                'price' => 'required|numeric|min:0',
                'max_students' => 'required|integer|min:1|max:1000',
                'is_online' => 'boolean',
                'is_active' => 'boolean'
            ]);

            // Mock creation - return the data with new ID
            $newCourse = array_merge($validated, [
                'id' => 3,
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString(),
                'institution' => [
                    'id' => $validated['institution_id'],
                    'name' => 'Tech University',
                    'type' => 'University'
                ],
                'instructor' => [
                    'id' => $validated['instructor_id'],
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'title' => 'Professor'
                ]
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Course created successfully',
                'data' => $newCourse
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
        $courses = [
            '1' => [
                'id' => 1,
                'course_code' => 'CS101',
                'title' => 'Introduction to Computer Science',
                'description' => 'Basic concepts of computer science and programming',
                'category' => 'Computer Science',
                'level' => 'Beginner',
                'duration_hours' => 40,
                'max_students' => 30,
                'price' => 299.99,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ],
                'instructor' => [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'title' => 'Professor'
                ],
                'enrollments' => [
                    [
                        'id' => 1,
                        'enrollment_date' => '2025-01-15',
                        'status' => 'enrolled',
                        'student' => [
                            'id' => 1,
                            'student_id' => 'STU2025001',
                            'first_name' => 'Alice',
                            'last_name' => 'Anderson'
                        ]
                    ]
                ]
            ],
            '2' => [
                'id' => 2,
                'course_code' => 'MATH201',
                'title' => 'Advanced Mathematics',
                'description' => 'Advanced mathematical concepts and applications',
                'category' => 'Mathematics',
                'level' => 'Intermediate',
                'duration_hours' => 60,
                'max_students' => 25,
                'price' => 399.99,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ],
                'instructor' => [
                    'id' => 2,
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'title' => 'Associate Professor'
                ],
                'enrollments' => [
                    [
                        'id' => 2,
                        'enrollment_date' => '2025-01-20',
                        'status' => 'enrolled',
                        'student' => [
                            'id' => 2,
                            'student_id' => 'STU2025002',
                            'first_name' => 'Bob',
                            'last_name' => 'Wilson'
                        ]
                    ]
                ]
            ]
        ];

        if (!isset($courses[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $courses[$id]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'institution_id' => 'sometimes|exists:institutions,id',
                'instructor_id' => 'sometimes|exists:instructors,id',
                'course_code' => 'sometimes|string|unique:courses,course_code,' . $id,
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'credits' => 'sometimes|integer|min:1|max:10',
                'category' => 'sometimes|string|max:255',
                'level' => 'sometimes|in:Beginner,Intermediate,Advanced',
                'duration_weeks' => 'sometimes|integer|min:1|max:52',
                'price' => 'sometimes|numeric|min:0',
                'max_students' => 'sometimes|integer|min:1|max:1000',
                'start_date' => 'sometimes|date',
                'end_date' => 'sometimes|date|after:start_date',
                'schedule' => 'sometimes|string',
                'location' => 'nullable|string',
                'is_online' => 'boolean',
                'is_active' => 'boolean'
            ]);

            $course->update($validated);
            $course->load(['institution', 'instructor']);

            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully',
                'data' => $course
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
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        // Check if course has active enrollments
        $activeEnrollments = $course->enrollments()->where('status', 'enrolled')->count();
        
        if ($activeEnrollments > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete course with active enrollments'
            ], 400);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully'
        ]);
    }
}
