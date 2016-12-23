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
            $this->string('firstname');
            $this->string('lastname');
            $this->string('gender');
            $this->string('email');
            $this->string('birth_date');
            $this->string('bank_number');
            $this->integer('country');
            $this->string('street');
            $this->string('house_number');
            $this->string('house_sub_number');
            $this->string('phone_number');
            $this->text('description');
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
