<?php
// Quick test for student creation fix
$data = [
    'first_name' => 'Test',
    'last_name' => 'Student',
    'email' => 'test.student@email.com',
    'date_of_birth' => '2000-01-01',
    'address' => '123 Test St',
    'city' => 'Test City',
    'state' => 'TS',
    'country' => 'USA',
    'postal_code' => '12345',
    'enrollment_date' => '2025-01-01'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/myapp/education-api/public/api/students');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=== STUDENT CREATION TEST ===\n";
echo "HTTP Code: $httpCode\n";
echo "Response: " . json_encode(json_decode($response, true), JSON_PRETTY_PRINT) . "\n";
?>
