<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderoccasionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderoccasionals', function (Blueprint $table) {
            $table->increments('oroId');
            $table->integer('oroDocument_id')->unsigned()->nullable();
            $table->foreign('oroDocument_id')->references('docId')->on('documents');
            $table->string('oroDocumentcode')->nullable();
            $table->date('oroDatestart');
            $table->date('oroDateend');
            $table->integer('oroClientproposal_id')->unsigned()->nullable();
            $table->foreign('oroClientproposal_id')->references('cprId')->on('clientproposals');
            $table->text('oroAllproposal');
            $table->integer('oroConfigdocument_id')->unsigned()->nullable();
            $table->foreign('oroConfigdocument_id')->references('cdoId')->on('configdocuments');
            $table->text('oroContentfinal');
            $table->text('oroWrited');
            $table->enum('oroState',['PENDIENTE','APROBADO','RECHAZADO'])->default('PENDIENTE');
            $table->enum('oroStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('orderoccasionals');
    }
}
