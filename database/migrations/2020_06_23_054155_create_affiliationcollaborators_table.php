<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliationcollaborators', function (Blueprint $table) {
            $table->increments('afcId');
            $table->integer('afcLegalization_id')->unsigned()->nullable();
            $table->foreign('afcLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->integer('afcHealth_id')->unsigned()->nullable();
            $table->foreign('afcHealth_id')->references('heaId')->on('settinghealths');
            $table->integer('afcPension_id')->unsigned()->nullable();
            $table->foreign('afcPension_id')->references('penId')->on('settingpensions');
            $table->integer('afcLayoff_id')->unsigned()->nullable();
            $table->foreign('afcLayoff_id')->references('layId')->on('settinglayoffs');
            $table->integer('afcRisk_id')->unsigned()->nullable();
            $table->foreign('afcRisk_id')->references('risId')->on('settingrisks');
            $table->integer('afcCompensation_id')->unsigned()->nullable();
            $table->foreign('afcCompensation_id')->references('comId')->on('settingcompensations');
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
        Schema::dropIfExists('affiliationcollaborators');
    }
}
