<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalRootUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_root_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id')->unique();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('profile_pic')->nullable();
            $table->timestamps();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_root_users');
    }
}
