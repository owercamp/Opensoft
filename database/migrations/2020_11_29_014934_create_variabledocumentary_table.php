<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariabledocumentaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variabledocumentary', function (Blueprint $table) {
            $table->Increments('valdId');
            $table->integer('valdDocument_id')->unsigned()->nullable();
            $table->foreign('valdDocument_id')->references('dodId')->on('documentsdocumentary');
            $table->string('valdName', 50);
            $table->enum('valdType',['Texto','Numérico','Moneda','Calendario']);
            $table->integer('valdLongitud');
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
        Schema::dropIfExists('variabledocumentary');
    }
}
