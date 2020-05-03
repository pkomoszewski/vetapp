<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('Opis');
            $table->integer('city_id');
            $table->integer('phone_id');
            $table->integer('phone_id');
            $table->integer('vet_id');
            $table->integer('godzina_otwarcia');
            $table->integer('godzina_zamkniecia');
            $table->string('dni_otwarte');
            $table->string('dni_zamkniete');
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
        Schema::dropIfExists('clinics');
    }
}
