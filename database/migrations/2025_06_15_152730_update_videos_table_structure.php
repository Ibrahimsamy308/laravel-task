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
            $table->dropColumn(['youtube_link',]);

            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            
            $table->string('url')->nullable();               
            $table->integer('duration')->nullable();

            $table->string('provider')->default('youtube')->comment('youtube','vimeo','upload'); // نوع المصدر

            $table->boolean('is_active')->default(true);
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};