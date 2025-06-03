<?php
// Simple Education API Server - No Database Dependencies
// This bypasses Laravel's complex database requirements

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Route handling
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string
$path = parse_url($requestUri, PHP_URL_PATH);

// Mock data
$institutions = [
    [
        'id' => 1,
        'name' => 'Harvard University',
        'address' => 'Cambridge, MA 02138',
        'phone' => '+1-617-495-1000',
        'email' => 'info@harvard.edu',
        'website' => 'https://www.harvard.edu',
        'founded' => 1636,
        'type' => 'Private',
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ],
    [
        'id' => 2,
        'name' => 'MIT',
        'address' => 'Cambridge, MA 02139',
        'phone' => '+1-617-253-1000',
        'email' => 'info@mit.edu',
        'website' => 'https://www.mit.edu',
        'founded' => 1861,
        'type' => 'Private',
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ]
];

$courses = [
    [
        'id' => 1,
        'name' => 'Introduction to Computer Science',
        'description' => 'Learn the fundamentals of programming and computer science',
        'credits' => 4,
        'instructor_id' => 1,
        'institution_id' => 1,
        'code' => 'CS101',
        'semester' => 'Fall 2024',
        'capacity' => 30,
        'enrolled' => 25,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ],
    [
        'id' => 2,
        'name' => 'Advanced Mathematics',
        'description' => 'Calculus and advanced mathematical concepts',
        'credits' => 3,
        'instructor_id' => 2,
        'institution_id' => 1,
        'code' => 'MATH301',
        'semester' => 'Fall 2024',
        'capacity' => 25,
        'enrolled' => 20,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ]
];

$students = [
    [
        'id' => 1,
        'student_id' => 'STU001',
        'name' => 'John Doe',
        'email' => 'john.doe@student.edu',
        'phone' => '+1-555-0123',
        'date_of_birth' => '2000-05-15',
        'institution_id' => 1,
        'major' => 'Computer Science',
        'year' => 'Sophomore',
        'gpa' => 3.75,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ],
    [
        'id' => 2,
        'student_id' => 'STU002', 
        'name' => 'Jane Smith',
        'email' => 'jane.smith@student.edu',
        'phone' => '+1-555-0124',
        'date_of_birth' => '1999-08-22',
        'institution_id' => 1,
        'major' => 'Mathematics',
        'year' => 'Junior',
        'gpa' => 3.92,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ]
];

$instructors = [
    [
        'id' => 1,
        'name' => 'Dr. Alice Johnson',
        'email' => 'alice.johnson@harvard.edu',
        'phone' => '+1-617-495-1234',
        'department' => 'Computer Science',
        'institution_id' => 1,
        'office' => 'Maxwell Dworkin 143',
        'specialization' => 'Artificial Intelligence',
        'years_experience' => 15,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ],
    [
        'id' => 2,
        'name' => 'Prof. Robert Brown',
        'email' => 'robert.brown@harvard.edu',
        'phone' => '+1-617-495-1235',
        'department' => 'Mathematics',
        'institution_id' => 1,
        'office' => 'Science Center 325',
        'specialization' => 'Applied Mathematics',
        'years_experience' => 22,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z'
    ]
];

$enrollments = [
    [
        'id' => 1,
        'student_id' => 1,
        'course_id' => 1,
        'enrollment_date' => '2024-01-15',
        'status' => 'active',
        'grade' => null,
        'attendance' => 95,
        'created_at' => '2024-01-15T00:00:00Z',
        'updated_at' => '2024-01-15T00:00:00Z'
    ],
    [
        'id' => 2,
        'student_id' => 2,
        'course_id' => 2,
        'enrollment_date' => '2024-01-16',
        'status' => 'active',
        'grade' => 'A',
        'attendance' => 98,
        'created_at' => '2024-01-16T00:00:00Z',
        'updated_at' => '2024-01-16T00:00:00Z'
    ]
];

// Helper functions
function sendJsonResponse($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit();
}

function getInputData() {
    return json_decode(file_get_contents('php://input'), true) ?: [];
}

function findById($array, $id) {
    foreach ($array as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }
    return null;
}

// Routing
switch (true) {
    // Test endpoint
    case $path === '/api/test':
        sendJsonResponse([
            'status' => 'success',
            'message' => 'Education API is working!',
            'timestamp' => date('Y-m-d H:i:s'),
            'endpoints' => [
                'GET /api/institutions',
                'GET /api/courses', 
                'GET /api/students',
                'GET /api/instructors',
                'GET /api/enrollments'
            ]
        ]);
        break;

    // Institutions
    case $path === '/api/institutions' && $requestMethod === 'GET':
        sendJsonResponse([
            'status' => 'success',
            'data' => $institutions,
            'total' => count($institutions),
            'page' => 1,
            'per_page' => 10
        ]);
        break;

    case preg_match('/^\/api\/institutions\/(\d+)$/', $path, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $institution = findById($institutions, $id);
        if ($institution) {
            sendJsonResponse(['status' => 'success', 'data' => $institution]);
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Institution not found'], 404);
        }
        break;

    // Courses
    case $path === '/api/courses' && $requestMethod === 'GET':
        sendJsonResponse([
            'status' => 'success',
            'data' => $courses,
            'total' => count($courses),
            'page' => 1,
            'per_page' => 10
        ]);
        break;

    case preg_match('/^\/api\/courses\/(\d+)$/', $path, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $course = findById($courses, $id);
        if ($course) {
            sendJsonResponse(['status' => 'success', 'data' => $course]);
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Course not found'], 404);
        }
        break;

    // Students
    case $path === '/api/students' && $requestMethod === 'GET':
        sendJsonResponse([
            'status' => 'success',
            'data' => $students,
            'total' => count($students),
            'page' => 1,
            'per_page' => 10
        ]);
        break;

    case preg_match('/^\/api\/students\/(\d+)$/', $path, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $student = findById($students, $id);
        if ($student) {
            sendJsonResponse(['status' => 'success', 'data' => $student]);
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Student not found'], 404);
        }
        break;

    // Instructors
    case $path === '/api/instructors' && $requestMethod === 'GET':
        sendJsonResponse([
            'status' => 'success',
            'data' => $instructors,
            'total' => count($instructors),
            'page' => 1,
            'per_page' => 10
        ]);
        break;

    case preg_match('/^\/api\/instructors\/(\d+)$/', $path, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $instructor = findById($instructors, $id);
        if ($instructor) {
            sendJsonResponse(['status' => 'success', 'data' => $instructor]);
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Instructor not found'], 404);
        }
        break;

    // Enrollments
    case $path === '/api/enrollments' && $requestMethod === 'GET':
        sendJsonResponse([
            'status' => 'success',
            'data' => $enrollments,
            'total' => count($enrollments),
            'page' => 1,
            'per_page' => 10
        ]);
        break;

    case preg_match('/^\/api\/enrollments\/(\d+)$/', $path, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $enrollment = findById($enrollments, $id);
        if ($enrollment) {
            sendJsonResponse(['status' => 'success', 'data' => $enrollment]);
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Enrollment not found'], 404);
        }
        break;

    // POST endpoints for testing
    case $path === '/api/courses' && $requestMethod === 'POST':
        $input = getInputData();
        sendJsonResponse([
            'status' => 'success',
            'message' => 'Course created successfully',
            'data' => [
                'id' => 999,
                'name' => $input['name'] ?? 'New Course',
                'description' => $input['description'] ?? 'Course description',
                'credits' => $input['credits'] ?? 3,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ], 201);
        break;

    case $path === '/api/students' && $requestMethod === 'POST':
        $input = getInputData();
        sendJsonResponse([
            'status' => 'success',
            'message' => 'Student created successfully',
            'data' => [
                'id' => 999,
                'student_id' => 'STU999',
                'name' => $input['name'] ?? 'New Student',
                'email' => $input['email'] ?? 'student@example.com',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ], 201);
        break;    // Root route - redirect to dashboard
    case $path === '/' && $requestMethod === 'GET':
        header('Location: /dashboard.html');
        exit();
        break;

    // Dashboard route
    case $path === '/dashboard.html' && $requestMethod === 'GET':
        $dashboardPath = __DIR__ . '/public/dashboard.html';
        if (file_exists($dashboardPath)) {
            header('Content-Type: text/html');
            readfile($dashboardPath);
            exit();
        } else {
            sendJsonResponse(['status' => 'error', 'message' => 'Dashboard not found'], 404);
        }
        break;

    // Default - route not found
    default:
        sendJsonResponse([
            'status' => 'error',
            'message' => 'Route not found',
            'path' => $path,
            'method' => $requestMethod,
            'available_endpoints' => [
                'GET /',
                'GET /dashboard.html',
                'GET /api/test',
                'GET /api/institutions',
                'GET /api/courses',
                'GET /api/students', 
                'GET /api/instructors',
                'GET /api/enrollments'
            ]
        ], 404);
        break;
}
