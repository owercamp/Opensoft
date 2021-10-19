<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderprovidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderproviders', function (Blueprint $table) {
            $table->increments('orpId');
            $table->integer('orpDocument_id')->unsigned();
            $table->foreign('orpDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('orpDocumentcode')->nullable();
            $table->integer('orpBillprovider_id')->unsigned();
            $table->foreign('orpBillprovider_id')->references('bpId')->on('billproviders');
            $table->text('orpOrders');
            $table->integer('orpSubtotal');
            $table->integer('orpIva');
            $table->integer('orpTotal');
            $table->integer('orpNote');
            $table->enum('orpStatus',['ACTIVA','ANULADA'])->default('ACTIVA');
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
        Schema::dropIfExists('orderproviders');
    }
}
