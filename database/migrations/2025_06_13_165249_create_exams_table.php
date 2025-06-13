<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->date("date");
            $table->integer("total_marks");
            $table->foreignId("course_id")->constrained('courses')->onDelete('cascade');
            $table->foreignId("doctor_id")->constrained('doctors')->onDelete('cascade');
            $table->foreignId("category_id")->constrained('categories')->onDelete('cascade');
            $table->foreignId("level_id")->constrained('levels')->onDelete('cascade');
            $table->enum("exam_type" , ["final" , "mid" , "quiz"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
