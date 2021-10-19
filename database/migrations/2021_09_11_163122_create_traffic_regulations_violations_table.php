<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficRegulationsViolationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('traffic_regulations_violations', function (Blueprint $table) {
      $table->Increments('trv_id');
      $table->integer('trv_config')->unsigned();
      $table->text('trv_content');
      $table->foreign('trv_config')->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('traffic_regulations_violations');
  }
}
