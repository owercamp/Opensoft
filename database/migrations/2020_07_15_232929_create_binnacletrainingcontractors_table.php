<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacletrainingcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacletrainingcontractors', function (Blueprint $table) {
            $table->increments('bicId');
            $table->integer('bicTraining_id')->unsigned();
            $table->foreign('bicTraining_id')->references('trcId')->on('trainingcontractors');
            $table->integer('bicBillcontractor_id')->unsigned();
            $table->foreign('bicBillcontractor_id')->references('bcId')->on('billcontractors');
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
        Schema::dropIfExists('binnacletrainingcontractors');
    }
}
