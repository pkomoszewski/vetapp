<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializationVetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialization_vet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('vet_id');
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
        Schema::dropIfExists('specialization_vet');
    }
}
