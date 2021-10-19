<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntranceexamscollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entranceexamscollaborators', function (Blueprint $table) {
            $table->increments('eecId');
            $table->date('eecDate');
            $table->integer('eecDocument_id')->unsigned();
            $table->foreign('eecDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('eecDocumentcode')->nullable();
            $table->integer('eecLegalization_id')->unsigned();
            $table->foreign('eecLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->string('eecCenter');
            $table->text('eecObservation');
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
        Schema::dropIfExists('entranceexamscollaborators');
    }
}
