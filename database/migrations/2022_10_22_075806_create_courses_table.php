<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('discount', 8, 2)->nullable();

            $table->boolean('active')->default(true);
            
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            $table->integer('duration_hours')->nullable();
            $table->string('type')->default('recorded')->comment('live','recorded');            
            $table->string('level')->nullable()->comment('beginner','intermediate','advanced');


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
        Schema::dropIfExists('courses');
    }
}