<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('procedures', function (Blueprint $table) {
      $table->Increments('pro_id');
      $table->integer("pro_doc")->unsigned();
      $table->text("pro_content");
      $table->foreign("pro_doc")->references("cdmId")->on("configdocumentsmanagerial");
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
    Schema::dropIfExists('procedures');
  }
}
