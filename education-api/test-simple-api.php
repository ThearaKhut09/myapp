<?php
// Quick API Test for Simple Server
echo "🧪 Testing Simple Education API Server...\n";
echo "=" . str_repeat("=", 50) . "\n\n";

function testEndpoint($url, $description) {
    echo "Testing: $description\n";
    echo "URL: $url\n";
    
    $context = stream_context_create([
        "http" => [
            "timeout" => 10,
            "header" => "Accept: application/json\r\n"
        ]
    ]);
    
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "❌ FAILED - Could not connect\n\n";
        return false;
    }
    
    $data = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "✅ SUCCESS - " . ($data['status'] ?? 'OK') . "\n";
        if (isset($data['data']) && is_array($data['data'])) {
            echo "📊 Records: " . count($data['data']) . "\n";
        }
        if (isset($data['message'])) {
            echo "💬 Message: " . $data['message'] . "\n";
        }
    } else {
        echo "⚠️  WARNING - Invalid JSON response\n";
    }
    echo "\n";
    return true;
}

// Test endpoints
$baseUrl = "http://127.0.0.1:8080";

$tests = [
    ["/api/test", "API Status Check"],
    ["/api/institutions", "Get All Institutions"],
    ["/api/institutions/1", "Get Institution by ID"],
    ["/api/courses", "Get All Courses"],
    ["/api/courses/1", "Get Course by ID"],
    ["/api/students", "Get All Students"],
    ["/api/students/1", "Get Student by ID"],
    ["/api/instructors", "Get All Instructors"],
    ["/api/instructors/1", "Get Instructor by ID"],
    ["/api/enrollments", "Get All Enrollments"],
    ["/api/enrollments/1", "Get Enrollment by ID"],
];

$passed = 0;
$total = count($tests);

foreach ($tests as $test) {
    if (testEndpoint($baseUrl . $test[0], $test[1])) {
        $passed++;
    }
}

echo "=" . str_repeat("=", 50) . "\n";
echo "🎯 TEST RESULTS: $passed/$total tests passed\n";

if ($passed === $total) {
    echo "🎉 ALL TESTS PASSED! Your API is working perfectly!\n";
    echo "\n🌐 Your Education API is ready to use:\n";
    echo "   Dashboard: http://127.0.0.1:8080/dashboard.html\n";
    echo "   API Base:  http://127.0.0.1:8080/api/\n";
} else {
    echo "⚠️  Some tests failed. Please check the server.\n";
}
echo "=" . str_repeat("=", 50) . "\n";
?>
