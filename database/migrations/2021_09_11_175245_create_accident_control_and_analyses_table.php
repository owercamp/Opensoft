<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentControlAndAnalysesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('accident_control_and_analyses', function (Blueprint $table) {
      $table->Increments('aca_id');
      $table->integer('aca_config')->unsigned();
      $table->text('aca_content');
      $table->foreign('aca_config')->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('accident_control_and_analyses');
  }
}
