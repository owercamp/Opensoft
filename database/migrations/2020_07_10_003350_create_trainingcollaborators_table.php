<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingcollaborators', function (Blueprint $table) {
            $table->increments('tcoId');
            $table->date('tcoDate');
            $table->integer('tcoDocument_id')->unsigned();
            $table->foreign('tcoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('tcoDocumentcode')->nullable();
            $table->string('tcoNametraining');
            $table->string('tcoNametrainer');
            $table->text('tcoLegalizations');
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
        Schema::dropIfExists('trainingcollaborators');
    }
}
