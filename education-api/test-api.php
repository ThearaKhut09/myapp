<?php
// Simple test script to verify API endpoints

echo "Education API Test Script\n";
echo "========================\n\n";

// Test URLs
$baseUrl = 'http://localhost:8000/api';
$endpoints = [
    'Test Route' => $baseUrl . '/test',
    'Status Route' => $baseUrl . '/status', 
    'Courses List' => $baseUrl . '/courses',
];

foreach ($endpoints as $name => $url) {
    echo "Testing: $name\n";
    echo "URL: $url\n";
    
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'Accept: application/json',
            'timeout' => 10
        ]
    ]);
    
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "Status: FAILED - Cannot connect to server\n";
    } else {
        $data = json_decode($response, true);
        if ($data) {
            echo "Status: SUCCESS\n";
            echo "Response: " . json_encode($data, JSON_PRETTY_PRINT) . "\n";
        } else {
            echo "Status: ERROR - Invalid JSON response\n";
            echo "Raw response: " . substr($response, 0, 200) . "\n";
        }
    }
    echo "\n" . str_repeat("-", 50) . "\n\n";
}
