<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id');
            $table->string('pharmacist_card_number')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othernames')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('profile_pic')->nullable();
            $table->string('region');
            $table->string('district');
            $table->string('town');
            $table->string('landmark');
            $table->string('residential_address')->nullable();
            $table->boolean('on_duty')->default(0);
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
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
        Schema::dropIfExists('pharmacists');
    }
}
