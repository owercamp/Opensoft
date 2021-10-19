<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestmessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestmessengers', function (Blueprint $table) {
            $table->increments('remId');
            $table->enum('remTypecliente',['PERMANENTE','OCASIONAL'])->nullable();
            $table->integer('remClientpermanent_id')->unsigned()->nullable();
            $table->foreign('remClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
            $table->integer('remClientoccasional_id')->unsigned()->nullable();
            $table->foreign('remClientoccasional_id')->references('oroId')->on('orderoccasionals');
            $table->integer('remMessenger_id')->unsigned()->nullable();
            $table->foreign('remMessenger_id')->references('smId')->on('settingservicesmessenger');
            $table->date('remDateservice');
            $table->time('remHourstart');
            $table->string('remAddressdestiny');
            $table->integer('remMunicipalitydestiny_id')->unsigned()->nullable();
            $table->foreign('remMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
            $table->string('remAddressorigin');
            $table->integer('remMunicipalityorigin_id')->unsigned()->nullable();
            $table->foreign('remMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
            $table->string('remContact');
            $table->string('remPhone');
            $table->text('remObservation');
            $table->enum('remStatus',['PENDIENTE','EJECUTANDO','FINALIZADO'])->default('PENDIENTE');
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
        Schema::dropIfExists('requestmessengers');
    }
}
