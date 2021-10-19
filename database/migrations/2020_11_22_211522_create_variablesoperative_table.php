<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesoperativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variablesoperative', function (Blueprint $table) {
            $table->Increments('valOId');
            $table->integer('valODocument_id')->unsigned()->nullable();
            $table->foreign('valODocument_id')->references('doOId')->on('documentsoperative');
            $table->string('valOName', 50);
            $table->enum('valOType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('valOLongitud');
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
        Schema::dropIfExists('variablesoperative');
    }
}
