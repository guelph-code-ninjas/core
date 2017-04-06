<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
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
            'submissions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('assignment_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('repository_id')->unsigned()->nullable();
                //Foreign Keys
                $table->foreign('assignment_id')->references('id')->on('assignments');
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('repository_id')->references('id')->on('repositories');
            
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
        Schema::dropIfExists('submissions');
    }
}
