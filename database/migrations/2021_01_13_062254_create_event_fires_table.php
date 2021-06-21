<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventFiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_fires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->dateTime('fired_at');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_fires');
    }
}
