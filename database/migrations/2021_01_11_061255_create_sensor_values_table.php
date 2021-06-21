<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_values', function (Blueprint $table) {
            $table->foreignId('sensor_id');
            $table->string('sensor_value');
            $table->dateTime('recorded_at');
            $table->timestamps();

            $table->primary(['sensor_id', 'created_at']);
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_values');
    }
}
