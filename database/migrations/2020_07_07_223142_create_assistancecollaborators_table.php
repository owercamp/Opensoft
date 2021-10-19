<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistancecollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistancecollaborators', function (Blueprint $table) {
            $table->increments('acoId');
            $table->date('acoDate');
            $table->integer('acoDocument_id')->unsigned();
            $table->foreign('acoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('acoDocumentcode')->nullable();
            $table->integer('acoLegalization_id')->unsigned();
            $table->foreign('acoLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->enum('acoAbsenteeism',['NO ASISTIÓ','LLEGÓ TARDE','SALIÓ TEMPRANO']);
            $table->time('acoHourentry')->nullable();
            $table->time('acoHourexit')->nullable();
            $table->text('acoDescription');
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
        Schema::dropIfExists('assistancecollaborators');
    }
}
