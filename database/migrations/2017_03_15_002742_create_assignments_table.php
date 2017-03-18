<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(
            'assignments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned();
                $table->string('name');
                $table->string('slug');
                $table->mediumText('description');
                $table->timestamps();
                $table->dateTime('start');
                $table->dateTime('due');
                //Foreign Keys
                $table->foreign('course_id')->references('id')->on('courses');
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
        Schema::dropIfExists('assignments');
    }
}
