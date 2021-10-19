<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistancecontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistancecontractors', function (Blueprint $table) {
            $table->increments('ascId');
            $table->date('ascDate');
            $table->integer('ascDocument_id')->unsigned();
            $table->foreign('ascDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('ascDocumentcode')->nullable();
            $table->integer('ascBillcontractor_id')->unsigned();
            $table->foreign('ascBillcontractor_id')->references('bcId')->on('billcontractors');
            $table->enum('ascAbsenteeism',['NO ASISTIO','LLEGO TARDE','SALIO TEMPRANO']);
            $table->time('ascHourentry')->nullable();
            $table->time('ascHourexit')->nullable();
            $table->text('ascDescription');
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
        Schema::dropIfExists('assistancecontractors');
    }
}
