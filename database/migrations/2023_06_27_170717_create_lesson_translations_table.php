<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('lesson_id');
            $table->string('locale')->index();
            $table->unique(['lesson_id', 'locale']);
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_translations');
    }
}