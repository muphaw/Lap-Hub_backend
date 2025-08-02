<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
<<<<<<<< HEAD:UniversityProjectExhibition/laravel/database/migrations/2025_07_23_082214_create_users_table.php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('password_hash');
            $table->string('photo')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
========
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('major');
            $table->string('batch');
            $table->timestamps();
>>>>>>>> dev:UniversityProjectExhibition/laravel/database/migrations/2025_07_15_141213_create_students_table.php
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};