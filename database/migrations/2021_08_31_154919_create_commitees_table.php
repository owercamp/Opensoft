<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommiteesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('commitees', function (Blueprint $table) {
      $table->Increments('com_id');
      $table->integer('comconfig')->unsigned();
      $table->text("comTextContent");
      $table->json("ComFirm");
      $table->foreign("comconfig")->references("cdmId")->on("configdocumentsmanagerial");
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
    Schema::dropIfExists('commitees');
  }
}
