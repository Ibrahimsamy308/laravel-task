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
        Schema::rename('usercourses', 'course_user');
        Schema::rename('userexams', 'user_exam');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('course_user', 'usercourses');
        Schema::rename('user_exam', 'userexams');

    }
};