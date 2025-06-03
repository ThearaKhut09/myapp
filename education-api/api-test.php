<?php
// CLI API Testing Script for Education API

echo "===============================\n";
echo "Education API Testing Script\n";
echo "===============================\n\n";

require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/bootstrap/app.php';
    
    // Test API endpoints directly
    $endpoints = [
        'GET /api/test' => ['GET', '/api/test'],
        'GET /api/status' => ['GET', '/api/status'],
        'GET /api/courses' => ['GET', '/api/courses'],
        'GET /api/institutions' => ['GET', '/api/institutions'],
        'GET /api/students' => ['GET', '/api/students'],
        'GET /api/instructors' => ['GET', '/api/instructors'],
        'GET /api/enrollments' => ['GET', '/api/enrollments'],
    ];
    
    foreach ($endpoints as $name => $config) {
        list($method, $path) = $config;
        
        echo "Testing: $name\n";
        echo str_repeat("-", 40) . "\n";
        
        try {
            $request = Illuminate\Http\Request::create($path, $method);
            $response = $app->handle($request);
            
            echo "Status Code: " . $response->getStatusCode() . "\n";
            echo "Content Type: " . $response->headers->get('Content-Type') . "\n";
            
            $content = $response->getContent();
            if ($response->headers->get('Content-Type') === 'application/json') {
                $json = json_decode($content, true);
                if ($json) {
                    echo "Response:\n" . json_encode($json, JSON_PRETTY_PRINT) . "\n";
                } else {
                    echo "Raw Content: " . substr($content, 0, 200) . "\n";
                }
            } else {
                echo "Raw Content: " . substr($content, 0, 200) . "\n";
            }
            
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        }
        
        echo "\n" . str_repeat("=", 60) . "\n\n";
    }
    
} catch (Exception $e) {
    echo "Bootstrap Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
