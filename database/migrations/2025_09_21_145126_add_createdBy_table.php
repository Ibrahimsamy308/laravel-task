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
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('createdBy_id')->nullable();
            $table->foreign('createdBy_id')->references('id')->on('admins')->onDelete('cascade');        
        });
         Schema::table('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('createdBy_id')->nullable();
            $table->foreign('createdBy_id')->references('id')->on('admins')->onDelete('cascade');        
        });
         Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('createdBy_id')->nullable();
            $table->foreign('createdBy_id')->references('id')->on('admins')->onDelete('cascade');        
        });
         Schema::table('materials', function (Blueprint $table) {
            $table->unsignedBigInteger('createdBy_id')->nullable();
            $table->foreign('createdBy_id')->references('id')->on('admins')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {

        });
    }
};