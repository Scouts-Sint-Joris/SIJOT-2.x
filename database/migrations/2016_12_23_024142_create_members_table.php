<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('bank_number')->nullable();
            $table->integer('country')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('house_sub_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('city')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('members');
    }
}
