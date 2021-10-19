<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestlogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestlogistics', function (Blueprint $table) {
            $table->increments('relId');
            $table->enum('relTypecliente',['PERMANENTE','OCASIONAL'])->nullable();
            $table->integer('relClientpermanent_id')->unsigned()->nullable();
            $table->foreign('relClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
            $table->integer('relClientoccasional_id')->unsigned()->nullable();
            $table->foreign('relClientoccasional_id')->references('oroId')->on('orderoccasionals');
            $table->integer('relLogistic_id')->unsigned()->nullable();
            $table->foreign('relLogistic_id')->references('slId')->on('settingserviceslogistic');
            $table->date('relDateservice');
            $table->time('relHourstart');
            $table->string('relAddressdestiny');
            $table->integer('relMunicipalitydestiny_id')->unsigned()->nullable();
            $table->foreign('relMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
            $table->string('relAddressorigin');
            $table->integer('relMunicipalityorigin_id')->unsigned()->nullable();
            $table->foreign('relMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
            $table->string('relContact');
            $table->string('relPhone');
            $table->enum('relStatus',['PENDIENTE','EJECUTANDO','FINALIZADO'])->default('PENDIENTE');
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
        Schema::dropIfExists('requestlogistics');
    }
}
