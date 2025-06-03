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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->string('course_code')->unique();
            $table->string('title');
            $table->text('description');
            $table->integer('credits');
            $table->string('category'); // Mathematics, Science, Arts, etc.
            $table->string('level'); // Beginner, Intermediate, Advanced
            $table->integer('duration_weeks');
            $table->decimal('price', 8, 2);
            $table->integer('max_students');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('schedule'); // Days and times
            $table->string('location')->nullable();
            $table->boolean('is_online')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
