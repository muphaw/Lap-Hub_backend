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
        Schema::create('projects', function (Blueprint $table) 
        {
            $table->id('project_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('project_name')->nullable();
            $table->text('project_detail')->nullable();
            $table->string('project_date', 25)->nullable();
            $table->string('project_link')->nullable();
            $table->text('project_image')->nullable();
            $table->string('collaborators')->nullable();
            $table->unsignedInteger('popularity')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};