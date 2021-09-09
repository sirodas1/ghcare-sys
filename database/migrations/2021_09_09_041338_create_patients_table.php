<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othernames')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('national_card_id')->unique();
            $table->string('profile_pic')->nullable();
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('occupation');
            $table->string('region');
            $table->string('district');
            $table->string('town');
            $table->string('landmark');
            $table->string('residential_address')->nullable();
            $table->string('next_of_kin');
            $table->string('nok_phone_number');
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
        Schema::dropIfExists('patients');
    }
}
