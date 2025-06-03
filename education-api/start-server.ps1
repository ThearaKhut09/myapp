# Laravel Education API Server Starter
Set-Location "c:\xampp\htdocs\myapp\education-api"

Write-Host "🚀 Starting Laravel Education API Server..." -ForegroundColor Green
Write-Host ""
Write-Host "📖 Server will be available at: http://127.0.0. 1:8000" -ForegroundColor Yellow
Write-Host ""
Write-Host "🔗 API Endpoints:" -ForegroundColor Cyan
Write-Host "  - GET  http://127.0.0.1:8000/api/courses" -ForegroundColor White
Write-Host "  - GET  http://127.0.0.1:8000/api/institutions" -ForegroundColor White  
Write-Host "  - GET  http://127.0.0.1:8000/api/students" -ForegroundColor White
Write-Host "  - GET  http://127.0.0.1:8000/api/instructors" -ForegroundColor White
Write-Host "  - GET  http://127.0.0.1:8000/api/enrollments" -ForegroundColor White
Write-Host ""
Write-Host "📝 Documentation: http://127.0.0.1:8000/api/docs" -ForegroundColor Magenta
Write-Host ""
Write-Host "⚡ Press Ctrl+C to stop the server" -ForegroundColor Red
Write-Host ""

php artisan serve --host=127.0.0.1 --port=8000
