<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activationcontractors', function (Blueprint $table) {
            $table->increments('accId');
            $table->enum('accTypecontractor',['MENSAJERIA','CARGA EXPRESS','SERVICIO ESPECIAL']);
            $table->integer('accContractormessenger_id')->unsigned()->nullable();
            $table->foreign('accContractormessenger_id')->references('cmId')->on('contractorsmessenger');
            $table->integer('accContractorcharge_id')->unsigned()->nullable();
            $table->foreign('accContractorcharge_id')->references('ccId')->on('contractorschargeexpress');
            $table->integer('accContractorespecial_id')->unsigned()->nullable();
            $table->foreign('accContractorespecial_id')->references('ceId')->on('contractorsserviceespecial');
            $table->enum('accState',['ACTIVADO','DESACTIVADO']);
            $table->date('accDateend')->nullable();
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
        Schema::dropIfExists('activationcontractors');
    }
}
