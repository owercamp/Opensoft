<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingsocialcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackingsocialcontractors', function (Blueprint $table) {
            $table->increments('tcId');
            $table->date('tcDate');
            $table->integer('tcDocument_id')->unsigned()->nullable();
            $table->foreign('tcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('tcDocumentcode')->nullable();
            $table->integer('tcBillcontractor_id')->unsigned()->nullable();
            $table->foreign('tcBillcontractor_id')->references('bcId')->on('billcontractors');
            $table->date('tcPeriodpay');
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
        Schema::dropIfExists('trackingsocialcontractors');
    }
}
