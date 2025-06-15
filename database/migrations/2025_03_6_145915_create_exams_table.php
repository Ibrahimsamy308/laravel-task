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
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
           
            $table->longText("questions")->nullable();
            
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