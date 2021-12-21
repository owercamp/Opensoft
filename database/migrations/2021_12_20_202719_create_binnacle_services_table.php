<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacleServicesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('binnacle_services', function (Blueprint $table) {
      $table->Increments('bs_id');
      $table->integer('bs_request')->comment('se relaciona con el identificador de la tabla request correspondiente segun el tipo de servicio [resquestcharge, resquestlogistic, requestmessengers, requestturisms, request_urban_transfers, request_intermunity_transfers]');
      $table->string('bs_type', 150);
      $table->text('bs_observations');
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
    Schema::dropIfExists('binnacle_services');
  }
}
