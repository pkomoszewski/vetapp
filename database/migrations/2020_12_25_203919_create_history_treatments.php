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
            $table->uuid('id')->primary();
            $table->string('description');
            $table->string('vet');
            $table->integer('bill');
            $table->unsignedBigInteger('ownwer_id');
            $table->foreign('ownwer_id')->references('id')->on('owners')->onDelete('cascade');
            $table->unsignedBigInteger('animal_id');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade'); 
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
