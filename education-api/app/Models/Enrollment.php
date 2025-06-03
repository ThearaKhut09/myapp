<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_date',
        'grade',
        'letter_grade',
        'status',
        'amount_paid',
        'payment_complete',
        'completion_date',
        'notes'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'completion_date' => 'date',
        'grade' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'payment_complete' => 'boolean',
    ];

    /**
     * Get the student for this enrollment
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the course for this enrollment
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Determine letter grade from numeric grade
     */
    public function calculateLetterGrade(): string
    {
        if (!$this->grade) return '';
        
        return match (true) {
            $this->grade >= 90 => 'A',
            $this->grade >= 80 => 'B',
            $this->grade >= 70 => 'C',
            $this->grade >= 60 => 'D',
            default => 'F'
        };
    }

    /**
     * Check if enrollment is active
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'enrolled';
    }
}
