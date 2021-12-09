<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestUrbanTransfersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('request_urban_transfers', function (Blueprint $table) {
      $table->increments('reuId');
      $table->enum('reuTypecliente', ['PERMANENTE', 'OCASIONAL'])->nullable();
      $table->integer('reuClientpermanent_id')->unsigned()->nullable();
      $table->integer('reuClientoccasional_id')->unsigned()->nullable();
      $table->integer('reuTransfer_id')->unsigned()->nullable();
      $table->date('reuDateservice');
      $table->time('reuHourstart');
      $table->string('reuAddressdestiny');
      $table->integer('reuMunicipalitydestiny_id')->unsigned()->nullable();
      $table->string('reuAddressorigin');
      $table->integer('reuMunicipalityorigin_id')->unsigned()->nullable();
      $table->string('reuContact');
      $table->string('reuPhone');
      $table->enum('reuStatus', ['PENDIENTE', 'EJECUTANDO', 'FINALIZADO'])->default('PENDIENTE');
      $table->foreign('reuClientpermanent_id')->references('lcoId')->on('legalizationscontractual');
      $table->foreign('reuClientoccasional_id')->references('oroId')->on('orderoccasionals');
      $table->foreign('reuTransfer_id')->references('strId')->on('settingservicestransfer');
      $table->foreign('reuMunicipalitydestiny_id')->references('munId')->on('settingmunicipalities');
      $table->foreign('reuMunicipalityorigin_id')->references('munId')->on('settingmunicipalities');
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
    Schema::dropIfExists('request_urban_transfers');
  }
}
