<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->increments('varId');
            $table->integer('varDocument_id')->unsigned()->nullable();
            $table->foreign('varDocument_id')->references('docId')->on('documents');
            $table->string('varName');
            $table->enum('varType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('varLongitud');
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
        Schema::dropIfExists('variables');
    }
}
