<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalParentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('legal_parents', function (Blueprint $table) {
      $table->Increments('lp_id');
      $table->string('lp_typeDoc', 80);
      $table->string('lp_Num', 30);
      $table->string('lp_year', 10);
      $table->string('lp_title', 30);
      $table->string('lp_article', 100);
      $table->string('lp_description', 200);
      $table->string('lp_area', 200);
      $table->string('lp_evidence', 30);
      $table->integer('lp_collaborator')->unsigned();
      $table->enum('lp_meet', ['Si', 'No']);
      $table->foreign('lp_collaborator')->references('coId')->on('collaborators');
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
    Schema::dropIfExists('legal_parents');
  }
}
