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
                $table->boolean('requiresRepository')->default(false);
                //In the future, these two should be extensions of the assignment
                //table instead of being contained within it.
                $table->float('similarity')->default(100);
                //The path where the ideal filesystem layout is contained.
                $table->string('fileChecker')->default("");
                //
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
