<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard.html');
});

Route::get('/dashboard', function () {
    return file_get_contents(public_path('dashboard.html'));
});

Route::get('/api-info', function () {
    return response()->json([
        'message' => 'Welcome to Education API',
        'version' => '1.0.0',
        'endpoints' => [
            'courses' => '/api/courses',
            'institutions' => '/api/institutions',
            'students' => '/api/students',
            'instructors' => '/api/instructors',
            'enrollments' => '/api/enrollments'
        ],
        'documentation' => '/dashboard.html'
    ]);
});
