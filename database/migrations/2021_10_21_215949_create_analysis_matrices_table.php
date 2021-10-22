<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisMatricesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('analysis_matrices', function (Blueprint $table) {
      $table->Increments('am_id');
      $table->integer('amDoc')->unsigned();
      $table->string('amActivity', 35);
      $table->enum('amFrequency', ['rutinaria', 'no rutinaria', 'esporadica']);
      $table->string('amDanger', 110);
      $table->string('amRick', 110);
      $table->enum('amTypeRick', ['accidente', 'enfermedad'])->nullable();
      $table->string('amExistsControl', 210);
      $table->enum('amLevel', ['eliminando el peligro', 'mitigando el peligro', 'utilizando protección']);
      $table->integer('amPExposed');
      $table->integer('amPTrained');
      $table->integer('amPPTrained');
      $table->integer('amPNotTrained');
      $table->integer('amExpoRick');
      $table->integer('amProbability');
      $table->integer('amSeverity');
      $table->integer('amProSeverity');
      $table->enum('amGradeRick', ['trivial', 'tolerable', 'moderado', 'importante', 'intolerable']);
      $table->foreign('amDoc')->references('domId')->on('documentsmanagerial');
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
    Schema::dropIfExists('analysis_matrices');
  }
}
