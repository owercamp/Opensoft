<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandbookcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handbookcollaborators', function (Blueprint $table) {
            $table->increments('hcoId');
            $table->integer('hcoPosition_id')->unsigned()->nullable();
            $table->foreign('hcoPosition_id')->references('pcoId')->on('positioncollaborators');
            $table->integer('hcoDocument_id')->unsigned()->nullable();
            $table->foreign('hcoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('hcoDocumentcode');
            $table->integer('hcoConfigdocument_id')->unsigned()->nullable();
            $table->foreign('hcoConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('hcoContentfinal');
            $table->text('hcoWrited');
            $table->enum('hcoStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('handbookcollaborators');
    }
}
