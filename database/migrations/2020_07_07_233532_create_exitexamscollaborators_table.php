<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitexamscollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exitexamscollaborators', function (Blueprint $table) {
            $table->increments('excId');
            $table->date('excDate');
            $table->integer('excDocument_id')->unsigned();
            $table->foreign('excDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('excDocumentcode')->nullable();
            $table->integer('excLegalization_id')->unsigned();
            $table->foreign('excLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->string('excCenter');
            $table->text('excObservation');
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
        Schema::dropIfExists('exitexamscollaborators');
    }
}
