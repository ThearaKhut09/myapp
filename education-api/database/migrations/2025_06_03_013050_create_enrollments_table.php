<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->date('enrollment_date');
            $table->decimal('grade', 5, 2)->nullable(); // 0.00 to 100.00
            $table->string('letter_grade')->nullable(); // A, B, C, D, F
            $table->enum('status', ['enrolled', 'completed', 'dropped', 'failed'])->default('enrolled');
            $table->decimal('amount_paid', 8, 2)->default(0);
            $table->boolean('payment_complete')->default(false);
            $table->date('completion_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Ensure a student can only enroll once per course
            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
