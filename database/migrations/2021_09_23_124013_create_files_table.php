<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id');
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->mediumText('symptoms');
            $table->double('temperature')->nullable();
            $table->double('bpm')->nullable();
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->string('prognosis');
            $table->string('diagnosis');
            $table->enum('health_status', ['UnIdentified','Diagnosed', 'Under-Treatment', 'Cured'])->default('UnIdentified');
            $table->boolean('contagious')->default(false);
            $table->datetime('time_of_detection');
            $table->datetime('time_of_cured');

            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('nurse_id')->references('id')->on('nurses');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            
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
        Schema::dropIfExists('files');
    }
}
