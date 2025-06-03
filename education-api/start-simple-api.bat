@echo off
cd /d "c:\xampp\htdocs\myapp\education-api"
echo.
echo ============================================
echo    🚀 SIMPLE EDUCATION API SERVER 🚀
echo ============================================
echo.
echo 📖 Server will be available at: http://127.0.0.1:8080
echo.
echo 🔗 API Endpoints:
echo   - GET  http://127.0.0.1:8080/api/test
echo   - GET  http://127.0.0.1:8080/api/courses
echo   - GET  http://127.0.0.1:8080/api/institutions  
echo   - GET  http://127.0.0.1:8080/api/students
echo   - GET  http://127.0.0.1:8080/api/instructors
echo   - GET  http://127.0.0.1:8080/api/enrollments
echo.
echo 📊 Dashboard: http://127.0.0.1:8080/dashboard.html
echo.
echo ⚡ Press Ctrl+C to stop the server
echo ============================================
echo.
php -S 127.0.0.1:8080 simple-api.php
