<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewExpressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('interview_expresses', function (Blueprint $table) {
      $table->Increments('int_id');
      $table->integer('int_IdCollaborator')->unsigned();
      $table->string('int_date', 150);
      $table->string('int_hour', 150);
      $table->string('int_compliance');
      $table->string('int_presence');
      $table->text('int_Obs', 500);
      $table->foreign('int_IdCollaborator')->references('ccId')->on('contractorschargeexpress');
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
    Schema::dropIfExists('interview_expresses');
  }
}
