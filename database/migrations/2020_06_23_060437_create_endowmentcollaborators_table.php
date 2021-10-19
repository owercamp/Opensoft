<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndowmentcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endowmentcollaborators', function (Blueprint $table) {
            $table->increments('ecoId');
            $table->integer('ecoDocument_id')->unsigned()->nullable();
            $table->foreign('ecoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('ecoDocumentcode')->nullable();
            $table->integer('ecoLegalization_id')->unsigned()->nullable();
            $table->foreign('ecoLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->text('ecoDelivery');
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
        Schema::dropIfExists('endowmentcollaborators');
    }
}
