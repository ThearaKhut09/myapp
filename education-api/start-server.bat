@echo off
cd /d "c:\xampp\htdocs\myapp\education-api"
echo Starting Laravel Education API Server...
echo.
echo Open your browser and go to: http://127.0.0.1:8000
echo.
echo API Endpoints available:
echo - GET  http://127.0.0.1:8000/api/courses
echo - GET  http://127.0.0.1:8000/api/institutions  
echo - GET  http://127.0.0.1:8000/api/students
echo - GET  http://127.0.0.1:8000/api/instructors
echo - GET  http://127.0.0.1:8000/api/enrollments
echo.
echo Press Ctrl+C to stop the server
echo.
php artisan serve --host=127.0.0.1 --port=8000
