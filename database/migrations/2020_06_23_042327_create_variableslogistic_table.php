<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariableslogisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variableslogistic', function (Blueprint $table) {
            $table->increments('valId');
            $table->integer('valDocument_id')->unsigned()->nullable();
            $table->foreign('valDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('valName');
            $table->enum('valType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('valLongitud');
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
        Schema::dropIfExists('variableslogistic');
    }
}
