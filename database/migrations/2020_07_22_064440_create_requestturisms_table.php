<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestturismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestturisms', function (Blueprint $table) {
            $table->increments('retId');
            $table->enum('retTypecliente',['PERMANENTE','OCASIONAL'])->nullable();
            $table->integer('retClientpermanent_id')->unsigned()->nullable();
            $table->foreign('retClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
            $table->integer('retClientoccasional_id')->unsigned()->nullable();
            $table->foreign('retClientoccasional_id')->references('oroId')->on('orderoccasionals');
            $table->integer('retTurism_id')->unsigned()->nullable();
            $table->foreign('retTurism_id')->references('stId')->on('settingservicesturism');
            $table->date('retDateservice');
            $table->time('retHourstart');
            $table->string('retAddressdestiny');
            $table->integer('retMunicipalitydestiny_id')->unsigned()->nullable();
            $table->foreign('retMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
            $table->string('retAddressorigin');
            $table->integer('retMunicipalityorigin_id')->unsigned()->nullable();
            $table->foreign('retMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
            $table->string('retContact');
            $table->string('retPhone');
            $table->enum('retStatus',['PENDIENTE','EJECUTANDO','FINALIZADO'])->default('PENDIENTE');
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
        Schema::dropIfExists('requestturisms');
    }
}
