<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('day');
            $table->string('hour'); 
            $table->string('opis');
            $table->boolean('status'); 
            $table->unsignedBigInteger('animal_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('vet_id');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade'); 
            $table->foreign('vet_id')->references('id')->on('vets')->onDelete('cascade'); 
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
        Schema::dropIfExists('reservations');
    }
}
