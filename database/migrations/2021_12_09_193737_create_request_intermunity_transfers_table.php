<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestIntermunityTransfersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('request_intermunity_transfers', function (Blueprint $table) {
      $table->increments('reiId');
      $table->enum('reiTypecliente', ['PERMANENTE', 'OCASIONAL'])->nullable();
      $table->integer('reiClientpermanent_id')->unsigned()->nullable();
      $table->integer('reiClientoccasional_id')->unsigned()->nullable();
      $table->integer('reiTransfer_id')->unsigned()->nullable();
      $table->date('reiDateservice');
      $table->time('reiHourstart');
      $table->string('reiAddressdestiny');
      $table->integer('reiMunicipalitydestiny_id')->unsigned()->nullable();
      $table->string('reiAddressorigin');
      $table->integer('reiMunicipalityorigin_id')->unsigned()->nullable();
      $table->string('reiContact');
      $table->string('reiPhone');
      $table->enum('reiStatus', ['PENDIENTE', 'EJECUTANDO', 'FINALIZADO'])->default('PENDIENTE');
      $table->foreign('reiClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
      $table->foreign('reiClientoccasional_id')->references('oroId')->on('orderoccasionals');
      $table->foreign('reiTransfer_id')->references('stmId')->on('settingservicestransfermunicipals');
      $table->foreign('reiMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
      $table->foreign('reiMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
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
    Schema::dropIfExists('request_intermunity_transfers');
  }
}
