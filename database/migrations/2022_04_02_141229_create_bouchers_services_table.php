<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouchersServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouchers_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('typeservices');
            $table->integer('origin')->unsigned()->comment('esta es la llave foranea con la tabla settingmunicipalities el campo munId');
            $table->integer('destiny')->unsigned()->comment('esta es la llave foranea con la tabla settingmunicipalities el campo munId');
            $table->string('colaborator');
            $table->integer('price');
            $table->enum('status', ['LIQUIDADO', 'CANCELADO']);
            $table->foreign('origin')->references('munId')->on('settingmunicipalities');
            $table->foreign('destiny')->references('munId')->on('settingmunicipalities');
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
        Schema::dropIfExists('bouchers_services');
    }
}
