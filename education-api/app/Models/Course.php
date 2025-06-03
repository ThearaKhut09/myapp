<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'institution_id',
        'instructor_id',
        'course_code',
        'title',
        'description',
        'credits',
        'category',
        'level',
        'duration_weeks',
        'price',
        'max_students',
        'start_date',
        'end_date',
        'schedule',
        'location',
        'is_online',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
        'is_online' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the institution this course belongs to
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * Get the instructor teaching this course
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Get all enrollments for this course
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all students enrolled in this course (Many-to-Many)
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                   ->withPivot(['enrollment_date', 'grade', 'letter_grade', 'status', 'amount_paid', 'payment_complete', 'completion_date', 'notes'])
                   ->withTimestamps();
    }

    /**
     * Get current enrollment count
     */
    public function getCurrentEnrollmentCountAttribute(): int
    {
        return $this->enrollments()->where('status', 'enrolled')->count();
    }

    /**
     * Check if course is full
     */
    public function getIsFullAttribute(): bool
    {
        return $this->current_enrollment_count >= $this->max_students;
    }
}
