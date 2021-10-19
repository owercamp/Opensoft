<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsperiodcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examsperiodcollaborators', function (Blueprint $table) {
            $table->increments('epcId');
            $table->date('epcDate');
            $table->integer('epcDocument_id')->unsigned();
            $table->foreign('epcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('epcDocumentcode')->nullable();
            $table->integer('epcLegalization_id')->unsigned();
            $table->foreign('epcLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->string('epcCenter');
            $table->text('epcObservation');
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
        Schema::dropIfExists('examsperiodcollaborators');
    }
}
