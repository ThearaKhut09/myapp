<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'emergency_contact',
        'emergency_phone',
        'enrollment_date',
        'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enrollment_date' => 'date',
    ];

    /**
     * Get all enrollments for this student
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all courses this student is enrolled in (Many-to-Many)
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                   ->withPivot(['enrollment_date', 'grade', 'letter_grade', 'status', 'amount_paid', 'payment_complete', 'completion_date', 'notes'])
                   ->withTimestamps();
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get active courses
     */
    public function activeCourses(): BelongsToMany
    {
        return $this->courses()->wherePivot('status', 'enrolled');
    }

    /**
     * Get completed courses
     */
    public function completedCourses(): BelongsToMany
    {
        return $this->courses()->wherePivot('status', 'completed');
    }
}
