<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesmanagerialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variablesmanagerial', function (Blueprint $table) {
            $table->Increments('valmid');
            $table->integer('valmDocument_id')->unsigned()->nullable();
            $table->foreign('valmDocument_id')->references('domId')->on('documentsmanagerial');
            $table->string('valmName', 50);
            $table->enum('valmType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('valmLongitud');
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
        Schema::dropIfExists('variablesmanagerial');
    }
}
