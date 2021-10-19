<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserServiceProceduresTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_service_procedures', function (Blueprint $table) {
      $table->Increments('usp_id');
      $table->integer("usp_config")->unsigned();
      $table->text('usp_content');
      $table->foreign('usp_config')->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('user_service_procedures');
  }
}
