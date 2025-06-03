<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index(Request $request): JsonResponse
    {
        // Mock data for testing without database
        $instructors = [
            [
                'id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@techuniversity.edu',
                'phone' => '+1-555-1001',
                'title' => 'Professor',
                'department' => 'Computer Science',
                'bio' => 'Experienced computer science professor with 15+ years in academia',
                'specialization' => 'Artificial Intelligence, Machine Learning',
                'qualification' => 'PhD in Computer Science',
                'experience_years' => 15,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ]
            ],
            [
                'id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@techuniversity.edu',
                'phone' => '+1-555-1002',
                'title' => 'Associate Professor',
                'department' => 'Mathematics',
                'bio' => 'Mathematics expert specializing in advanced calculus and statistics',
                'specialization' => 'Applied Mathematics, Statistics',
                'qualification' => 'PhD in Mathematics',
                'experience_years' => 12,
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'Tech University',
                    'type' => 'University'
                ]
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $instructors,
            'total' => count($instructors),
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
                'institution_id' => 'required|integer',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'department' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'specialization' => 'nullable|string|max:255',
                'hire_date' => 'required|date',
                'salary' => 'nullable|numeric|min:0',
                'is_active' => 'boolean'
            ]);

            // Mock response for testing without database
            $instructor = array_merge($validated, [
                'id' => rand(1000, 9999),
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString(),
                'institution' => [
                    'id' => $validated['institution_id'],
                    'name' => 'Mock Institution',
                    'type' => 'university'
                ]
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Instructor created successfully',
                'data' => $instructor
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
        $instructors = [
            1 => [
                'id' => 1,
                'first_name' => 'Dr. Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@mit.edu',
                'phone' => '+1-617-555-0001',
                'department' => 'Computer Science',
                'title' => 'Professor',
                'bio' => 'PhD in Computer Science with 15 years of teaching experience.',
                'specialization' => 'Machine Learning, Algorithms',
                'hire_date' => '2020-08-15',
                'salary' => 85000.00,
                'is_active' => true,
                'created_at' => '2020-08-15T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 1,
                    'name' => 'MIT',
                    'type' => 'university',
                    'address' => '77 Massachusetts Ave, Cambridge, MA 02139'
                ],
                'courses' => [
                    [
                        'id' => 1,
                        'title' => 'Introduction to Computer Science',
                        'code' => 'CS101',
                        'credits' => 3,
                        'enrollments_count' => 25
                    ]
                ]
            ],
            2 => [
                'id' => 2,
                'first_name' => 'Prof. Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@harvard.edu',
                'phone' => '+1-617-555-0002',
                'department' => 'Mathematics',
                'title' => 'Associate Professor',
                'bio' => 'Mathematics expert specializing in statistics and data analysis.',
                'specialization' => 'Statistics, Data Science',
                'hire_date' => '2019-01-10',
                'salary' => 78000.00,
                'is_active' => true,
                'created_at' => '2019-01-10T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'institution' => [
                    'id' => 2,
                    'name' => 'Harvard University',
                    'type' => 'university',
                    'address' => 'Cambridge, MA 02138'
                ],
                'courses' => []
            ]
        ];

        if (!isset($instructors[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Instructor not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $instructors[$id]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $instructor = Instructor::find($id);

        if (!$instructor) {
            return response()->json([
                'success' => false,
                'message' => 'Instructor not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'institution_id' => 'sometimes|exists:institutions,id',
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:instructors,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'department' => 'sometimes|string|max:255',
                'title' => 'sometimes|string|max:255',
                'bio' => 'nullable|string',
                'specialization' => 'nullable|string|max:255',
                'hire_date' => 'sometimes|date',
                'salary' => 'nullable|numeric|min:0',
                'is_active' => 'boolean'
            ]);

            $instructor->update($validated);
            $instructor->load('institution');

            return response()->json([
                'success' => true,
                'message' => 'Instructor updated successfully',
                'data' => $instructor
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
        $instructor = Instructor::find($id);

        if (!$instructor) {
            return response()->json([
                'success' => false,
                'message' => 'Instructor not found'
            ], 404);
        }

        // Check if instructor has courses
        $coursesCount = $instructor->courses()->count();
        
        if ($coursesCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete instructor with existing courses'
            ], 400);
        }

        $instructor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Instructor deleted successfully'
        ]);
    }

    /**
     * Get courses for a specific instructor
     */
    public function courses(string $id): JsonResponse
    {
        $instructor = Instructor::with(['courses.enrollments.student'])->find($id);

        if (!$instructor) {
            return response()->json([
                'success' => false,
                'message' => 'Instructor not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $instructor->courses
        ]);
    }
}
