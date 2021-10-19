<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billcontractors', function (Blueprint $table) {
            $table->increments('bcId');
            $table->integer('bcDocument_id')->unsigned();
            $table->foreign('bcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('bcDocumentcode');
            $table->enum('bcTypecontractor',['MENSAJERIA','CARGA EXPRESS','SERVICIO ESPECIAL']);
            $table->integer('bcContractormessenger_id')->unsigned()->nullable();
            $table->foreign('bcContractormessenger_id')->references('cmId')->on('contractorsmessenger');
            $table->integer('bcContractorcharge_id')->unsigned()->nullable();
            $table->foreign('bcContractorcharge_id')->references('ccId')->on('contractorschargeexpress');
            $table->integer('bcContractorespecial_id')->unsigned()->nullable();
            $table->foreign('bcContractorespecial_id')->references('ceId')->on('contractorsserviceespecial');
            $table->integer('bcConfigdocument_id')->unsigned()->nullable();
            $table->foreign('bcConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('bcContentfinal');
            $table->text('bcWrited');
            $table->enum('bcState',['PENDIENTE','APROBADO','RECHAZADO'])->default('PENDIENTE');
            $table->enum('bcStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('billcontractors');
    }
}
