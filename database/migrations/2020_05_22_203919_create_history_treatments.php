<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('opis');
            $table->string('weterynarz');
            $table->integer('rachunek');
            $table->unsignedBigInteger('animal_id');
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
        Schema::dropIfExists('history_treatments');
    }
}
