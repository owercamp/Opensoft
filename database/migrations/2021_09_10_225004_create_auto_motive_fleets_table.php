<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoMotiveFleetsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('auto_motive_fleets', function (Blueprint $table) {
      $table->Increments('amf_id');
      $table->integer('amf_config')->unsigned();
      $table->text('amf_Content');
      $table->foreign("amf_config")->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('auto_motive_fleets');
  }
}
