<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixEPPSTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('matrix_e_p_p_s', function (Blueprint $table) {
      $table->Increments('me_id');
      $table->integer('meDoc')->unsigned();
      $table->string('meEPP', 35);
      $table->string('meDes', 110);
      $table->string('meNor', 110);
      $table->string('meObs', 110);
      $table->text('meFil');
      $table->foreign('meDoc')->references('domId')->on('documentsmanagerial');
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
    Schema::dropIfExists('matrix_e_p_p_s');
  }
}
