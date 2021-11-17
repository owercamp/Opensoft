<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewCollaboratorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('interview_collaborators', function (Blueprint $table) {
      $table->Increments('int_id');
      $table->integer('int_IdCollaborator')->unsigned();
      $table->date('int_date');
      $table->dateTime('int_hour');
      $table->string('int_compliance');
      $table->string('int_presence');
      $table->text('int_Obs', 500);
      $table->foreign('int_IdCollaborator')->references('coId')->on('collaborators');
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
    Schema::dropIfExists('interview_collaborators');
  }
}
