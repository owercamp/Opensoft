<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billcollaborators', function (Blueprint $table) {
            $table->increments('bcoId');
            $table->integer('bcoDocument_id')->unsigned()->nullable();
            $table->foreign('bcoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('bcoDocumentcode');
            $table->integer('bcoCollaborator_id')->unsigned()->nullable();
            $table->foreign('bcoCollaborator_id')->references('coId')->on('collaborators');
            $table->integer('bcoConfigdocument_id')->unsigned()->nullable();
            $table->foreign('bcoConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('bcoContentfinal');
            $table->text('bcoWrited');
            $table->enum('bcoState',['PENDIENTE','APROBADO','RECHAZADO'])->default('PENDIENTE');
            $table->enum('bcoStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('billcollaborators');
    }
}
