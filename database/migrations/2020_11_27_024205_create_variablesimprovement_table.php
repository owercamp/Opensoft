<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesimprovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variablesimprovement', function (Blueprint $table) {
            $table->Increments('valIId');
            $table->integer('valIDocument_id')->unsigned()->nullable();
            $table->foreign('valIDocument_id')->references('doIId')->on('documentsimprovement');
            $table->string('valIName', 50);
            $table->enum('valIType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('valILongitud');
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
        Schema::dropIfExists('variablesimprovement');
    }
}
