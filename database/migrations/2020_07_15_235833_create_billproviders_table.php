<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillprovidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billproviders', function (Blueprint $table) {
            $table->increments('bpId');
            $table->integer('bpDocument_id')->unsigned();
            $table->foreign('bpDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('bpDocumentcode');
            $table->integer('bpProvider_id')->unsigned();
            $table->foreign('bpProvider_id')->references('proId')->on('providers');
            $table->integer('bpConfigdocument_id')->unsigned()->nullable();
            $table->foreign('bpConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('bpContentfinal');
            $table->text('bpWrited');
            $table->enum('bpState',['PENDIENTE','APROBADO','RECHAZADO'])->default('PENDIENTE');
            $table->enum('bpStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('billproviders');
    }
}
