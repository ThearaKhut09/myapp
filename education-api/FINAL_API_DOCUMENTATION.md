# Education API - Complete Documentation

## Overview
A comprehensive Laravel-based RESTful API for managing educational institutions, courses, students, instructors, and enrollments. This API provides full CRUD operations for all resources with proper validation, error handling, and relationship management.

## 🚀 Base URL
```
http://localhost/myapp/education-api/public/api
```

## 📊 API Status
- **Status**: ✅ Fully Operational
- **Version**: 1.0.0
- **Data Mode**: Mock Data (Database-Independent)
- **Response Format**: JSON

## 🔗 Quick Health Check
```bash
GET /api/status
GET /api/test
```

---

## 📚 Available Resources

### 1. Institutions (`/institutions`)
Manage educational institutions like universities, colleges, and schools.

**Endpoints:**
- `GET /institutions` - List all institutions
- `GET /institutions/{id}` - Get specific institution
- `POST /institutions` - Create new institution
- `PUT /institutions/{id}` - Update institution
- `DELETE /institutions/{id}` - Delete institution

**Sample Data Structure:**
```json
{
    "id": 1,
    "name": "MIT",
    "description": "Massachusetts Institute of Technology",
    "address": "77 Massachusetts Ave",
    "city": "Cambridge",
    "state": "MA",
    "country": "USA",
    "postal_code": "02139",
    "phone": "+1-617-253-1000",
    "email": "info@mit.edu",
    "website": "https://web.mit.edu",
    "type": "university",
    "is_active": true,
    "created_at": "2020-01-01T00:00:00Z",
    "updated_at": "2025-01-01T00:00:00Z",
    "courses": [...],
    "instructors": [...]
}
```

### 2. Instructors (`/instructors`)
Manage teaching staff and faculty members.

**Endpoints:**
- `GET /instructors` - List all instructors
- `GET /instructors/{id}` - Get specific instructor
- `POST /instructors` - Create new instructor
- `PUT /instructors/{id}` - Update instructor
- `DELETE /instructors/{id}` - Delete instructor

**Sample Data Structure:**
```json
{
    "id": 1,
    "first_name": "Dr. Sarah",
    "last_name": "Johnson",
    "email": "sarah.johnson@mit.edu",
    "phone": "+1-617-555-0001",
    "department": "Computer Science",
    "title": "Professor",
    "bio": "PhD in Computer Science with 15 years of teaching experience.",
    "specialization": "Machine Learning, Algorithms",
    "hire_date": "2020-08-15",
    "salary": 85000.00,
    "is_active": true,
    "institution": {...},
    "courses": [...]
}
```

### 3. Courses (`/courses`)
Manage educational courses and programs.

**Endpoints:**
- `GET /courses` - List all courses
- `GET /courses/{id}` - Get specific course
- `POST /courses` - Create new course
- `PUT /courses/{id}` - Update course
- `DELETE /courses/{id}` - Delete course

**Sample Data Structure:**
```json
{
    "id": 1,
    "course_code": "CS101",
    "title": "Introduction to Computer Science",
    "description": "Basic concepts of computer science and programming",
    "category": "Computer Science",
    "level": "Beginner",
    "duration_hours": 40,
    "max_students": 30,
    "price": 299.99,
    "is_active": true,
    "institution": {...},
    "instructor": {...},
    "enrollments": [...]
}
```

### 4. Students (`/students`)
Manage student information and records.

**Endpoints:**
- `GET /students` - List all students
- `GET /students/{id}` - Get specific student
- `POST /students` - Create new student
- `PUT /students/{id}` - Update student
- `DELETE /students/{id}` - Delete student

**Sample Data Structure:**
```json
{
    "id": 1,
    "student_id": "STU2025001",
    "first_name": "Alice",
    "last_name": "Anderson",
    "email": "alice.anderson@email.com",
    "phone": "+1-555-0101",
    "date_of_birth": "2000-03-15",
    "gender": "female",
    "address": "123 Main St",
    "city": "Boston",
    "state": "MA",
    "country": "USA",
    "postal_code": "02101",
    "emergency_contact": "Jane Anderson",
    "emergency_phone": "+1-555-0102",
    "enrollment_date": "2025-01-10",
    "status": "active",
    "enrollments": [...]
}
```

### 5. Enrollments (`/enrollments`)
Manage student course enrollments and academic records.

**Endpoints:**
- `GET /enrollments` - List all enrollments
- `GET /enrollments/{id}` - Get specific enrollment
- `POST /enrollments` - Create new enrollment
- `PUT /enrollments/{id}` - Update enrollment
- `DELETE /enrollments/{id}` - Delete enrollment

**Sample Data Structure:**
```json
{
    "id": 1,
    "enrollment_date": "2025-01-10",
    "completion_date": null,
    "status": "enrolled",
    "grade": 85.5,
    "letter_grade": "B+",
    "attendance_percentage": 95.0,
    "payment_status": "paid",
    "amount_paid": 1500.00,
    "notes": "Excellent student with strong participation",
    "student": {...},
    "course": {...}
}
```

---

## 🔧 API Usage Examples

### Create a New Institution
```bash
curl -X POST http://localhost/myapp/education-api/public/api/institutions \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Stanford University",
    "description": "Leading research university in Silicon Valley",
    "address": "450 Serra Mall",
    "city": "Stanford",
    "state": "CA",
    "country": "USA",
    "postal_code": "94305",
    "phone": "+1-650-723-2300",
    "email": "info@stanford.edu",
    "website": "https://stanford.edu",
    "type": "university",
    "is_active": true
  }'
```

### Create a New Student
```bash
curl -X POST http://localhost/myapp/education-api/public/api/students \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Emily",
    "last_name": "Johnson",
    "email": "emily.johnson@email.com",
    "phone": "+1-555-0456",
    "date_of_birth": "2001-05-12",
    "gender": "female",
    "address": "789 Pine Street",
    "city": "Boston",
    "state": "MA",
    "country": "USA",
    "postal_code": "02115",
    "emergency_contact": "David Johnson",
    "emergency_phone": "+1-555-0457",
    "enrollment_date": "2025-01-25",
    "status": "active"
  }'
```

### Create an Enrollment
```bash
curl -X POST http://localhost/myapp/education-api/public/api/enrollments \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 1,
    "enrollment_date": "2025-01-25",
    "amount_paid": 1500.00,
    "payment_complete": true,
    "notes": "Student enrolled with scholarship"
  }'
```

---

## ✅ HTTP Status Codes

- **200 OK** - Successful GET requests
- **201 Created** - Successful POST requests
- **404 Not Found** - Resource not found
- **422 Unprocessable Entity** - Validation errors
- **500 Internal Server Error** - Server errors

## 📝 Response Format

### Success Response
```json
{
    "status": "success",
    "data": {...},
    "message": "Operation completed successfully"
}
```

### Error Response
```json
{
    "status": "error",
    "message": "Error description",
    "errors": {...}
}
```

### List Response
```json
{
    "status": "success",
    "data": [...],
    "total": 50,
    "page": 1,
    "per_page": 10
}
```

---

## 🔍 Validation Rules

### Institution Validation
- `name`: required, string, max:255
- `description`: optional, string
- `address`: required, string
- `city`: required, string, max:255
- `state`: required, string, max:255
- `country`: required, string, max:255
- `postal_code`: required, string, max:10
- `phone`: optional, string, max:20
- `email`: optional, email
- `website`: optional, url
- `type`: required, in:university,college,institute,school
- `is_active`: boolean

### Student Validation
- `first_name`: required, string, max:255
- `last_name`: required, string, max:255
- `email`: required, email
- `phone`: optional, string, max:20
- `date_of_birth`: required, date, before:today
- `gender`: optional, in:male,female,other
- `address`: required, string
- `city`: required, string, max:255
- `state`: required, string, max:255
- `country`: required, string, max:255
- `postal_code`: required, string, max:10
- `emergency_contact`: optional, string, max:255
- `emergency_phone`: optional, string, max:20
- `enrollment_date`: required, date
- `status`: in:active,inactive,graduated,suspended

### Course Validation
- `institution_id`: required, integer
- `instructor_id`: required, integer
- `title`: required, string, max:255
- `course_code`: required, string, max:20
- `description`: required, string
- `category`: required, string, max:255
- `level`: required, in:Beginner,Intermediate,Advanced
- `duration_hours`: optional, integer, min:1
- `max_students`: required, integer, min:1
- `price`: required, numeric, min:0
- `is_active`: boolean

### Instructor Validation
- `institution_id`: required, integer
- `first_name`: required, string, max:255
- `last_name`: required, string, max:255
- `email`: required, email
- `phone`: optional, string, max:20
- `department`: required, string, max:255
- `title`: required, string, max:255
- `bio`: optional, string
- `specialization`: optional, string, max:255
- `hire_date`: required, date
- `salary`: optional, numeric, min:0
- `is_active`: boolean

### Enrollment Validation
- `student_id`: required, integer
- `course_id`: required, integer
- `enrollment_date`: required, date
- `amount_paid`: optional, numeric, min:0
- `payment_complete`: boolean
- `notes`: optional, string

---

## 🧪 Testing

The API has been comprehensively tested with the following scenarios:

✅ **All GET Endpoints** - Working with mock data
✅ **All POST Endpoints** - Working with validation
✅ **Resource Relationships** - Properly nested data
✅ **Error Handling** - 404, 422, 500 responses
✅ **Validation** - All fields properly validated
✅ **Mock Data** - Realistic and comprehensive

### Test Script
Run the comprehensive test suite:
```bash
cd /path/to/education-api
php final-test.php
```

---

## 🏗️ Architecture

### Technologies Used
- **Framework**: Laravel 11
- **Language**: PHP 8.2+
- **Server**: Apache/Nginx
- **Data**: Mock/JSON (Database-independent)
- **API Style**: RESTful

### Project Structure
```
education-api/
├── app/Http/Controllers/     # API Controllers
├── routes/api.php           # API Routes
├── bootstrap/app.php        # Application Bootstrap
├── final-test.php          # Test Suite
└── API_DOCUMENTATION.md    # This Documentation
```

---

## 🎯 Features Completed

✅ **Complete CRUD Operations** for all 5 resources
✅ **RESTful API Design** with proper HTTP methods
✅ **Data Validation** with detailed error messages
✅ **Resource Relationships** (One-to-One, One-to-Many, Many-to-Many)
✅ **Error Handling** with appropriate HTTP status codes
✅ **Mock Data Implementation** for database-independent testing
✅ **Comprehensive Testing** with validation scenarios
✅ **API Documentation** with examples and usage

---

## 📞 API Contact Information

For any questions or issues with this Education API:

- **Project**: Laravel Education Management System
- **Version**: 1.0.0
- **Status**: Production Ready (Mock Data Mode)
- **Documentation**: This file
- **Test Suite**: `final-test.php`

---

*This Education API provides a complete foundation for educational management systems with full CRUD capabilities, proper validation, and comprehensive testing.*
