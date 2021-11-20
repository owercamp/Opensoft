<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesCollaboratorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('references_collaborators', function (Blueprint $table) {
      $table->Increments('rc_id');
      $table->integer('rc_collaborator_id')->unsigned()->comment('se relaciona con el id del colaborador de la tabla Collaborator');
      $table->string('colRef1', 200);
      $table->string('cedRef1', 150);
      $table->string('numRef1', 50);
      $table->enum('ver1', ['VERIFICADA', 'NO VERIFICADA']);
      $table->text('obsver1');
      $table->string('colRef2', 200);
      $table->string('cedRef2', 150);
      $table->string('numRef2', 50);
      $table->enum('ver2', ['VERIFICADA', 'NO VERIFICADA']);
      $table->text('obsver2');
      $table->string('rsRef1', 200);
      $table->string('nitRef1', 50);
      $table->string('addRef1', 200);
      $table->string('phoRef1', 50);
      $table->string('ciuRef1', 200);
      $table->enum('verRef1', ['VERIFICADA', 'NO VERIFICADA']);
      $table->text('obsverRef1');
      $table->string('rsRef2', 200);
      $table->string('nitRef2', 50);
      $table->string('addRef2', 200);
      $table->string('phoRef2', 50);
      $table->string('ciuRef2', 200);
      $table->enum('verRef2', ['VERIFICADA', 'NO VERIFICADA']);
      $table->text('obsverRef2');
      $table->foreign('rc_collaborator_id')->references('coId')->on('collaborators');
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
    Schema::dropIfExists('references_collaborators');
  }
}
