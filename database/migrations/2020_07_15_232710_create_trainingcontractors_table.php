<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingcontractors', function (Blueprint $table) {
            $table->increments('trcId');
            $table->date('trcDate');
            $table->integer('trcDocument_id')->unsigned();
            $table->foreign('trcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('trcDocumentcode')->nullable();
            $table->string('trcNametraining');
            $table->string('trcNametrainer');
            $table->text('trcLegalizations');
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
        Schema::dropIfExists('trainingcontractors');
    }
}
