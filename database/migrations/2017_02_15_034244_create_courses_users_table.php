<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'courses_users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->enum('role', ['instructor', 'assistant', 'student']);
                //Foreign Keys
                $table->foreign('course_id')->references('id')->on('courses');
                $table->foreign('user_id')->references('id')->on('users');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_users');
    }
}
