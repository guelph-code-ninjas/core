<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'repositories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                //This path is relative to Laravel's storage path.
                $table->string('path')->unique();
                $table->boolean('initialized')->default(false);
                $table->enum('backend', ['git']);
                $table->timestamps();
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
        Schema::dropIfExists('repositories');
    }
}
