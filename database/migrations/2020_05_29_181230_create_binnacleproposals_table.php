<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacleproposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacleproposals', function (Blueprint $table) {
            $table->increments('bpId');
            $table->date('bpDate');
            $table->string('bpObservation');
            $table->integer('bpClientproposal_id')->unsigned();
            $table->foreign('bpClientproposal_id')->references('cprId')->on('clientproposals');
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
        Schema::dropIfExists('binnacleproposals');
    }
}
