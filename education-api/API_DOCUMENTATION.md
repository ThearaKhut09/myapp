# Education API Documentation

## Overview
The Education API is a comprehensive Laravel-based RESTful API system for managing educational institutions, courses, students, instructors, and enrollments.

## Base URL
```
http://localhost:8000/api
```

## Authentication
Currently, the API endpoints are publicly accessible for testing purposes. In production, you would typically implement authentication using Laravel Sanctum or Passport.

## Response Format
All API responses follow a consistent JSON format:

### Success Response
```json
{
    "status": "success",
    "data": [...],
    "total": 10,
    "page": 1,
    "per_page": 10
}
```

### Error Response
```json
{
    "status": "error",
    "message": "Error description",
    "errors": {
        "field": ["Validation error message"]
    }
}
```

## Endpoints

### Health Check
Check API status and service availability.

#### GET /api/test
Returns basic API information.

**Response:**
```json
{
    "status": "success",
    "message": "Education API is working!",
    "timestamp": "2025-06-03T03:36:07.088810Z",
    "version": "1.0.0"
}
```

#### GET /api/status
Returns API and service status.

**Response:**
```json
{
    "status": "online",
    "database": "connected",
    "services": {
        "institutions": "available",
        "courses": "available",
        "students": "available",
        "instructors": "available",
        "enrollments": "available"
    }
}
```

---

## Institutions

### GET /api/institutions
Retrieve a list of all institutions.

**Query Parameters:**
- `type` (optional): Filter by institution type (University, College, School)
- `search` (optional): Search by institution name
- `country` (optional): Filter by country
- `per_page` (optional): Number of records per page (default: 10)

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Tech University",
            "type": "University",
            "description": "Leading technology university with cutting-edge programs",
            "website": "https://techuniversity.edu",
            "email": "info@techuniversity.edu",
            "phone": "+1-555-0100",
            "address": "123 University Ave",
            "city": "Boston",
            "state": "MA",
            "country": "USA",
            "postal_code": "02101",
            "is_active": true,
            "created_at": "2025-01-01T00:00:00Z",
            "updated_at": "2025-01-01T00:00:00Z"
        }
    ],
    "total": 2,
    "page": 1,
    "per_page": 10
}
```

### GET /api/institutions/{id}
Retrieve a specific institution by ID.

### POST /api/institutions
Create a new institution.

### PUT /api/institutions/{id}
Update an existing institution.

### DELETE /api/institutions/{id}
Delete an institution.

---

## Courses

### GET /api/courses
Retrieve a list of all courses.

**Query Parameters:**
- `category` (optional): Filter by course category
- `level` (optional): Filter by course level (Beginner, Intermediate, Advanced)
- `search` (optional): Search by course title or code
- `institution_id` (optional): Filter by institution
- `instructor_id` (optional): Filter by instructor

**Response:**
```json
{
    "status": "success",
    "data": [
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
            "created_at": "2025-01-01T00:00:00Z",
            "updated_at": "2025-01-01T00:00:00Z",
            "institution": {
                "id": 1,
                "name": "Tech University",
                "type": "University"
            },
            "instructor": {
                "id": 1,
                "first_name": "John",
                "last_name": "Doe",
                "title": "Professor"
            }
        }
    ],
    "total": 2,
    "page": 1,
    "per_page": 10
}
```

### GET /api/courses/{id}
Retrieve a specific course with enrollments.

### POST /api/courses
Create a new course.

**Request Body:**
```json
{
    "institution_id": 1,
    "instructor_id": 1,
    "course_code": "PHY301",
    "title": "Advanced Physics",
    "description": "Advanced concepts in physics",
    "category": "Science",
    "level": "Advanced",
    "price": 499.99,
    "max_students": 20,
    "is_online": false,
    "is_active": true
}
```

---

## Students

### GET /api/students
Retrieve a list of all students.

**Response:**
```json
{
    "status": "success",
    "data": [
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
            "created_at": "2025-01-10T00:00:00Z",
            "updated_at": "2025-01-10T00:00:00Z"
        }
    ]
}
```

### GET /api/students/{id}
Retrieve a specific student.

### POST /api/students
Create a new student.

### PUT /api/students/{id}
Update student information.

### DELETE /api/students/{id}
Delete a student record.

---

## Instructors

### GET /api/instructors
Retrieve a list of all instructors.

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@techuniversity.edu",
            "phone": "+1-555-1001",
            "title": "Professor",
            "department": "Computer Science",
            "bio": "Experienced computer science professor with 15+ years in academia",
            "specialization": "Artificial Intelligence, Machine Learning",
            "qualification": "PhD in Computer Science",
            "experience_years": 15,
            "is_active": true,
            "created_at": "2025-01-01T00:00:00Z",
            "updated_at": "2025-01-01T00:00:00Z",
            "institution": {
                "id": 1,
                "name": "Tech University",
                "type": "University"
            }
        }
    ]
}
```

### GET /api/instructors/{id}
Retrieve a specific instructor.

### POST /api/instructors
Create a new instructor.

### PUT /api/instructors/{id}
Update instructor information.

### DELETE /api/instructors/{id}
Delete an instructor record.

---

## Enrollments

### GET /api/enrollments
Retrieve a list of all enrollments.

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "student_id": 1,
            "course_id": 1,
            "enrollment_date": "2025-01-15",
            "completion_date": null,
            "status": "enrolled",
            "grade": null,
            "attendance_percentage": 85.5,
            "payment_status": "paid",
            "created_at": "2025-01-15T00:00:00Z",
            "updated_at": "2025-01-15T00:00:00Z",
            "student": {
                "id": 1,
                "student_id": "STU2025001",
                "first_name": "Alice",
                "last_name": "Anderson",
                "email": "alice.anderson@email.com"
            },
            "course": {
                "id": 1,
                "course_code": "CS101",
                "title": "Introduction to Computer Science",
                "instructor": {
                    "id": 1,
                    "first_name": "John",
                    "last_name": "Doe",
                    "title": "Professor"
                },
                "institution": {
                    "id": 1,
                    "name": "Tech University",
                    "type": "University"
                }
            }
        }
    ]
}
```

### GET /api/enrollments/{id}
Retrieve a specific enrollment.

### POST /api/enrollments
Create a new enrollment.

**Request Body:**
```json
{
    "student_id": 1,
    "course_id": 1,
    "enrollment_date": "2025-06-03",
    "status": "enrolled",
    "payment_status": "paid"
}
```

### PUT /api/enrollments/{id}
Update enrollment information.

### DELETE /api/enrollments/{id}
Delete an enrollment record.

---

## Database Relationships

The API implements the following database relationships:

- **One-to-Many**: Institution → Courses, Institution → Instructors
- **One-to-Many**: Instructor → Courses
- **Many-to-Many**: Students ↔ Courses (through Enrollments)

## Error Codes

- `200` - Success
- `201` - Created successfully
- `400` - Bad request
- `404` - Resource not found
- `422` - Validation error
- `500` - Internal server error

## Testing

Use the provided test scripts to verify API functionality:
- `php api-test.php` - Basic endpoint testing
- `php complete-api-test.php` - Comprehensive CRUD testing

## Example Usage

### Using cURL

```bash
# Get all courses
curl -X GET "http://localhost:8000/api/courses" \
     -H "Accept: application/json"

# Create a new course
curl -X POST "http://localhost:8000/api/courses" \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "institution_id": 1,
       "instructor_id": 1,
       "course_code": "PHY301",
       "title": "Advanced Physics",
       "description": "Advanced concepts in physics",
       "category": "Science",
       "level": "Advanced",
       "price": 499.99,
       "max_students": 20,
       "is_active": true
     }'

# Get specific course
curl -X GET "http://localhost:8000/api/courses/1" \
     -H "Accept: application/json"
```

---

*This Education API provides a complete foundation for educational management systems with RESTful endpoints, proper data relationships, and comprehensive CRUD operations.*
