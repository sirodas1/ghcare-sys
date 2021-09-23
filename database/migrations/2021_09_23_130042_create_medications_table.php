<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('pharmacist_id')->nullable();
            $table->unsignedBigInteger('drug_id')->nullable();

            $table->enum('dosage', ['3 Times Daily', '2 Times Daily', 'Once a Day']);
            $table->boolean('completed')->default(false);
            $table->timestamp('start_date');
            $table->datetime('end_date');

            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('pharmacist_id')->references('id')->on('pharmacists');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('drug_id')->references('id')->on('inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
