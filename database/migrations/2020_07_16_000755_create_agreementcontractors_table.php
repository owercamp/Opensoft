<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreementcontractors', function (Blueprint $table) {
            $table->increments('agcId');
            $table->integer('agcDocument_id')->unsigned()->nullable();
            $table->foreign('agcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('agcDocumentcode')->nullable();
            $table->enum('agcTypecontractor',['MENSAJERIA','CARGA EXPRESS','SERVICIO ESPECIAL']);
            $table->integer('agcBillcontractor_id')->unsigned()->nullable();
            $table->foreign('agcBillcontractor_id')->references('bcId')->on('billcontractors');
            $table->integer('agcAlliesmessenger_id')->unsigned()->nullable();
            $table->foreign('agcAlliesmessenger_id')->references('amId')->on('alliesmessenger');
            $table->integer('agcAlliescharge_id')->unsigned()->nullable();
            $table->foreign('agcAlliescharge_id')->references('acId')->on('alliescharge');
            $table->integer('agcAlliesespecial_id')->unsigned()->nullable();
            $table->foreign('agcAlliesespecial_id')->references('aeId')->on('alliesespecial');
            $table->integer('agcConfigdocument_id')->unsigned()->nullable();
            $table->foreign('agcConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('agcContentfinal');
            $table->text('agcWrited');
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
        Schema::dropIfExists('agreementcontractors');
    }
}
