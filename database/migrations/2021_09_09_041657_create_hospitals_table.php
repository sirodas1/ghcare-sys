<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('region');
            $table->string('district');
            $table->string('town');
            $table->string('building_address');
            $table->string('institution_id');
            $table->enum('type_of_institution',['Hospital', 'Clinic', 'Heath Center']);
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
        Schema::dropIfExists('hospitals');
    }
}
