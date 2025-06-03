<?php
// Simple test to check if basic Laravel bootstrap works
require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "Laravel bootstrap successful!" . PHP_EOL;
    
    // Test basic route resolution
    $request = Illuminate\Http\Request::create('/api/test', 'GET');
    $response = $app->handle($request);
    
    echo "Status Code: " . $response->getStatusCode() . PHP_EOL;
    echo "Content: " . $response->getContent() . PHP_EOL;
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . ":" . $e->getLine() . PHP_EOL;
}
