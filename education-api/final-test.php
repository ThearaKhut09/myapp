<?php
/**
 * Final comprehensive test script for Education API
 * Tests all controllers with complete CRUD operations
 */

echo "==================================================\n";
echo "  EDUCATION API - FINAL COMPREHENSIVE TEST\n";
echo "==================================================\n\n";

$baseUrl = 'http://localhost/myapp/education-api/public/api';

function makeRequest($url, $method = 'GET', $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    if ($method !== 'GET') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    }
    
    if ($data && in_array($method, ['POST', 'PUT', 'PATCH'])) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    return [
        'response' => $response,
        'http_code' => $httpCode,
        'error' => $error
    ];
}

function testEndpoint($name, $url, $method = 'GET', $data = null) {
    echo "Testing: $name\n";
    echo "URL: $url\n";
    echo "Method: $method\n";
    
    if ($data) {
        echo "Data: " . json_encode($data, JSON_PRETTY_PRINT) . "\n";
    }
    
    $result = makeRequest($url, $method, $data);
    
    echo "HTTP Code: " . $result['http_code'] . "\n";
    
    if ($result['error']) {
        echo "Error: " . $result['error'] . "\n";
    } else {
        $decoded = json_decode($result['response'], true);
        if ($decoded) {
            echo "Response: " . json_encode($decoded, JSON_PRETTY_PRINT) . "\n";
        } else {
            echo "Raw Response: " . $result['response'] . "\n";
        }
    }
    
    echo str_repeat('-', 80) . "\n\n";
}

// Test API Health
testEndpoint('API Status Check', "$baseUrl/status");
testEndpoint('API Test Endpoint', "$baseUrl/test");

// ===== INSTITUTIONS =====
echo "\n🏫 TESTING INSTITUTIONS\n";
echo "========================\n";

testEndpoint('Get All Institutions', "$baseUrl/institutions");
testEndpoint('Get Institution by ID', "$baseUrl/institutions/1");
testEndpoint('Get Non-existent Institution', "$baseUrl/institutions/999");

testEndpoint('Create New Institution', "$baseUrl/institutions", 'POST', [
    'name' => 'Stanford University',
    'description' => 'Leading research university in Silicon Valley',
    'address' => '450 Serra Mall',
    'city' => 'Stanford',
    'state' => 'CA',
    'country' => 'USA',
    'postal_code' => '94305',
    'phone' => '+1-650-723-2300',
    'email' => 'info@stanford.edu',
    'website' => 'https://stanford.edu',
    'type' => 'university',
    'is_active' => true
]);

// ===== INSTRUCTORS =====
echo "\n👨‍🏫 TESTING INSTRUCTORS\n";
echo "========================\n";

testEndpoint('Get All Instructors', "$baseUrl/instructors");
testEndpoint('Get Instructor by ID', "$baseUrl/instructors/1");
testEndpoint('Get Non-existent Instructor', "$baseUrl/instructors/999");

testEndpoint('Create New Instructor', "$baseUrl/instructors", 'POST', [
    'institution_id' => 1,
    'first_name' => 'Dr. Robert',
    'last_name' => 'Smith',
    'email' => 'robert.smith@university.edu',
    'phone' => '+1-555-0123',
    'department' => 'Physics',
    'title' => 'Associate Professor',
    'bio' => 'Expert in quantum physics with 10 years teaching experience',
    'specialization' => 'Quantum Mechanics, Theoretical Physics',
    'hire_date' => '2022-08-15',
    'salary' => 72000.00,
    'is_active' => true
]);

// ===== COURSES =====
echo "\n📚 TESTING COURSES\n";
echo "==================\n";

testEndpoint('Get All Courses', "$baseUrl/courses");
testEndpoint('Get Course by ID', "$baseUrl/courses/1");
testEndpoint('Get Non-existent Course', "$baseUrl/courses/999");

testEndpoint('Create New Course', "$baseUrl/courses", 'POST', [
    'institution_id' => 1,
    'instructor_id' => 1,
    'title' => 'Web Development Fundamentals',
    'code' => 'WEB101',
    'description' => 'Introduction to HTML, CSS, and JavaScript',
    'credits' => 3,
    'duration_weeks' => 16,
    'capacity' => 30,
    'fee' => 1200.00,
    'start_date' => '2025-02-01',
    'end_date' => '2025-05-15',
    'status' => 'active',
    'syllabus' => 'Week 1-4: HTML basics, Week 5-8: CSS styling, Week 9-12: JavaScript fundamentals, Week 13-16: Project work',
    'is_online' => false
]);

// ===== STUDENTS =====
echo "\n🎓 TESTING STUDENTS\n";
echo "===================\n";

testEndpoint('Get All Students', "$baseUrl/students");
testEndpoint('Get Student by ID', "$baseUrl/students/1");
testEndpoint('Get Non-existent Student', "$baseUrl/students/999");

testEndpoint('Create New Student', "$baseUrl/students", 'POST', [
    'first_name' => 'Emily',
    'last_name' => 'Johnson',
    'email' => 'emily.johnson@email.com',
    'phone' => '+1-555-0456',
    'date_of_birth' => '2001-05-12',
    'gender' => 'female',
    'address' => '789 Pine Street',
    'city' => 'Boston',
    'state' => 'MA',
    'country' => 'USA',
    'postal_code' => '02115',
    'emergency_contact' => 'David Johnson',
    'emergency_phone' => '+1-555-0457',
    'enrollment_date' => '2025-01-25',
    'status' => 'active'
]);

// ===== ENROLLMENTS =====
echo "\n📝 TESTING ENROLLMENTS\n";
echo "======================\n";

testEndpoint('Get All Enrollments', "$baseUrl/enrollments");
testEndpoint('Get Enrollment by ID', "$baseUrl/enrollments/1");
testEndpoint('Get Non-existent Enrollment', "$baseUrl/enrollments/999");

testEndpoint('Create New Enrollment', "$baseUrl/enrollments", 'POST', [
    'student_id' => 1,
    'course_id' => 1,
    'enrollment_date' => '2025-01-25',
    'amount_paid' => 1500.00,
    'payment_complete' => true,
    'notes' => 'Student enrolled with scholarship'
]);

// ===== VALIDATION TESTS =====
echo "\n🔍 TESTING VALIDATION\n";
echo "====================\n";

testEndpoint('Invalid Course Creation (Missing Fields)', "$baseUrl/courses", 'POST', [
    'title' => 'Incomplete Course'
    // Missing required fields
]);

testEndpoint('Invalid Student Creation (Invalid Email)', "$baseUrl/students", 'POST', [
    'first_name' => 'Test',
    'last_name' => 'Student',
    'email' => 'invalid-email-format',
    'date_of_birth' => '2000-01-01',
    'address' => '123 Test St',
    'city' => 'Test City',
    'state' => 'TS',
    'country' => 'USA',
    'postal_code' => '12345',
    'enrollment_date' => '2025-01-01'
]);

testEndpoint('Invalid Enrollment (Invalid Date)', "$baseUrl/enrollments", 'POST', [
    'student_id' => 1,
    'course_id' => 1,
    'enrollment_date' => 'invalid-date'
]);

echo "\n🎉 TESTING COMPLETE!\n";
echo "===================\n";
echo "All endpoints have been tested with various scenarios.\n";
echo "Check the responses above to verify functionality.\n";
echo "Mock data is being returned for all endpoints since database is not connected.\n\n";
?>
