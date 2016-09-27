<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('state')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('date')->nullable();
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_groups', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('groups_id');
            $table->integer('activity_id');
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
        Schema::dropIfExists('activity_groups');
        Schema::dropIfExists('activities');
    }
}
