<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Test route to verify API is working
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Education API is working!',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});

// API Status route
Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'database' => 'connected', // This would check actual DB in production
        'services' => [
            'institutions' => 'available',
            'courses' => 'available',
            'students' => 'available',
            'instructors' => 'available',
            'enrollments' => 'available'
        ]
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Institution Routes
Route::prefix('institutions')->group(function () {
    Route::get('/', [InstitutionController::class, 'index']);
    Route::post('/', [InstitutionController::class, 'store']);
    Route::get('/{id}', [InstitutionController::class, 'show']);
    Route::put('/{id}', [InstitutionController::class, 'update']);
    Route::delete('/{id}', [InstitutionController::class, 'destroy']);
    Route::get('/{id}/courses', [InstitutionController::class, 'courses']);
    Route::get('/{id}/instructors', [InstitutionController::class, 'instructors']);
});

// Instructor Routes
Route::prefix('instructors')->group(function () {
    Route::get('/', [InstructorController::class, 'index']);
    Route::post('/', [InstructorController::class, 'store']);
    Route::get('/{id}', [InstructorController::class, 'show']);
    Route::put('/{id}', [InstructorController::class, 'update']);
    Route::delete('/{id}', [InstructorController::class, 'destroy']);
    Route::get('/{id}/courses', [InstructorController::class, 'courses']);
});

// Course Routes
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/', [CourseController::class, 'store']);
    Route::get('/{id}', [CourseController::class, 'show']);
    Route::put('/{id}', [CourseController::class, 'update']);
    Route::delete('/{id}', [CourseController::class, 'destroy']);
    Route::get('/{id}/students', [CourseController::class, 'students']);
    Route::get('/{id}/enrollments', [CourseController::class, 'enrollments']);
});

// Student Routes
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);
    Route::get('/{id}/courses', [StudentController::class, 'courses']);
    Route::get('/{id}/enrollments', [StudentController::class, 'enrollments']);
});

// Enrollment Routes
Route::prefix('enrollments')->group(function () {
    Route::get('/', [EnrollmentController::class, 'index']);
    Route::post('/', [EnrollmentController::class, 'store']);
    Route::get('/{id}', [EnrollmentController::class, 'show']);
    Route::put('/{id}', [EnrollmentController::class, 'update']);
    Route::delete('/{id}', [EnrollmentController::class, 'destroy']);
    Route::post('/bulk', [EnrollmentController::class, 'bulkEnroll']);
});

// Resource routes (alternative approach using Laravel resource routing)
// Route::apiResource('institutions', InstitutionController::class);
// Route::apiResource('instructors', InstructorController::class);
// Route::apiResource('courses', CourseController::class);
// Route::apiResource('students', StudentController::class);
// Route::apiResource('enrollments', EnrollmentController::class);