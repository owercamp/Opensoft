<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestcharges', function (Blueprint $table) {
            $table->increments('recId');
            $table->enum('recTypecliente',['PERMANENTE','OCASIONAL'])->nullable();
            $table->integer('recClientpermanent_id')->unsigned()->nullable();
            $table->foreign('recClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
            $table->integer('recClientoccasional_id')->unsigned()->nullable();
            $table->foreign('recClientoccasional_id')->references('oroId')->on('orderoccasionals');
            $table->integer('recCharge_id')->unsigned()->nullable();
            $table->foreign('recCharge_id')->references('scId')->on('settingservicescharge');
            $table->date('recDateservice');
            $table->time('recHourstart');
            $table->string('recAddressdestiny');
            $table->integer('recMunicipalitydestiny_id')->unsigned()->nullable();
            $table->foreign('recMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
            $table->string('recAddressorigin');
            $table->integer('recMunicipalityorigin_id')->unsigned()->nullable();
            $table->foreign('recMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
            $table->string('recContact');
            $table->string('recPhone');
            $table->enum('recStatus',['PENDIENTE','EJECUTANDO','FINALIZADO'])->default('PENDIENTE');
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
        Schema::dropIfExists('requestcharges');
    }
}
