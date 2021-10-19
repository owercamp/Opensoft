<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacletrainingcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacletrainingcollaborators', function (Blueprint $table) {
            $table->increments('btcId');
            $table->integer('btcTraining_id')->unsigned();
            $table->foreign('btcTraining_id')->references('tcoId')->on('trainingcollaborators');
            $table->integer('btcLegalization_id')->unsigned();
            $table->foreign('btcLegalization_id')->references('bcoId')->on('billcollaborators');
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
        Schema::dropIfExists('binnacletrainingcollaborators');
    }
}
