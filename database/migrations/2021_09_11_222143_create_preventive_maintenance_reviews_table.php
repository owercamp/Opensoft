<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreventiveMaintenanceReviewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('preventive_maintenance_reviews', function (Blueprint $table) {
      $table->Increments('pmr_id');
      $table->integer('pmr_config')->unsigned();
      $table->text('pmr_content');
      $table->foreign('pmr_config')->references('cdlId')->on('configdocumentslogistic');
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
    Schema::dropIfExists('preventive_maintenance_reviews');
  }
}
