<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidirectionalCommunicationSystemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bidirectional_communication_systems', function (Blueprint $table) {
      $table->Increments('bcs_id');
      $table->integer('bcs_config')->unsigned();
      $table->text('bcs_content');
      $table->foreign('bcs_config')->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('bidirectional_communication_systems');
  }
}
