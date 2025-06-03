<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index(Request $request): JsonResponse
    {
        // Mock data for testing without database
        $institutions = [
            [
                'id' => 1,
                'name' => 'Tech University',
                'type' => 'University',
                'description' => 'Leading technology university with cutting-edge programs',
                'website' => 'https://techuniversity.edu',
                'email' => 'info@techuniversity.edu',
                'phone' => '+1-555-0100',
                'address' => '123 University Ave',
                'city' => 'Boston',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02101',
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z'
            ],
            [
                'id' => 2,
                'name' => 'Community College Center',
                'type' => 'College',
                'description' => 'Community-focused education with practical programs',
                'website' => 'https://communitycc.edu',
                'email' => 'admissions@communitycc.edu',
                'phone' => '+1-555-0200',
                'address' => '456 College Rd',
                'city' => 'Springfield',
                'state' => 'IL',
                'country' => 'USA',
                'postal_code' => '62701',
                'is_active' => true,
                'created_at' => '2025-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z'
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $institutions,
            'total' => count($institutions),
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
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email',
                'website' => 'nullable|url',
                'type' => 'required|in:university,college,institute,school',
                'is_active' => 'boolean'
            ]);

            // Mock response for testing without database
            $institution = array_merge($validated, [
                'id' => rand(1000, 9999),
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Institution created successfully',
                'data' => $institution
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
        $institutions = [
            1 => [
                'id' => 1,
                'name' => 'MIT',
                'description' => 'Massachusetts Institute of Technology - A world-renowned research university.',
                'address' => '77 Massachusetts Ave',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02139',
                'phone' => '+1-617-253-1000',
                'email' => 'info@mit.edu',
                'website' => 'https://web.mit.edu',
                'type' => 'university',
                'is_active' => true,
                'created_at' => '2020-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'courses' => [
                    [
                        'id' => 1,
                        'title' => 'Introduction to Computer Science',
                        'code' => 'CS101',
                        'credits' => 3,
                        'instructor' => [
                            'id' => 1,
                            'first_name' => 'Dr. Sarah',
                            'last_name' => 'Johnson'
                        ]
                    ]
                ],
                'instructors' => [
                    [
                        'id' => 1,
                        'first_name' => 'Dr. Sarah',
                        'last_name' => 'Johnson',
                        'department' => 'Computer Science',
                        'title' => 'Professor'
                    ]
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Harvard University',
                'description' => 'A prestigious Ivy League research university.',
                'address' => 'Massachusetts Hall',
                'city' => 'Cambridge',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02138',
                'phone' => '+1-617-495-1000',
                'email' => 'info@harvard.edu',
                'website' => 'https://harvard.edu',
                'type' => 'university',
                'is_active' => true,
                'created_at' => '2020-01-01T00:00:00Z',
                'updated_at' => '2025-01-01T00:00:00Z',
                'courses' => [],
                'instructors' => [
                    [
                        'id' => 2,
                        'first_name' => 'Prof. Michael',
                        'last_name' => 'Brown',
                        'department' => 'Mathematics',
                        'title' => 'Associate Professor'
                    ]
                ]
            ]
        ];

        if (!isset($institutions[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Institution not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $institutions[$id]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $institution = Institution::find($id);

        if (!$institution) {
            return response()->json([
                'success' => false,
                'message' => 'Institution not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'address' => 'sometimes|string',
                'city' => 'sometimes|string|max:255',
                'state' => 'sometimes|string|max:255',
                'country' => 'sometimes|string|max:255',
                'postal_code' => 'sometimes|string|max:10',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email',
                'website' => 'nullable|url',
                'type' => 'sometimes|in:university,college,institute,school',
                'is_active' => 'boolean'
            ]);

            $institution->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Institution updated successfully',
                'data' => $institution
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
        $institution = Institution::find($id);

        if (!$institution) {
            return response()->json([
                'success' => false,
                'message' => 'Institution not found'
            ], 404);
        }

        // Check if institution has courses or instructors
        $coursesCount = $institution->courses()->count();
        $instructorsCount = $institution->instructors()->count();
        
        if ($coursesCount > 0 || $instructorsCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete institution with existing courses or instructors'
            ], 400);
        }

        $institution->delete();

        return response()->json([
            'success' => true,
            'message' => 'Institution deleted successfully'
        ]);
    }

    /**
     * Get courses for a specific institution
     */
    public function courses(string $id): JsonResponse
    {
        $institution = Institution::with(['courses.instructor'])->find($id);

        if (!$institution) {
            return response()->json([
                'success' => false,
                'message' => 'Institution not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $institution->courses
        ]);
    }
}
