<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientbiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientbiddings', function (Blueprint $table) {
            $table->increments('cbiId');
            $table->string('cbiNumberprocess');
            $table->date('cbiDateopen');
            $table->date('cbiDateclose');
            $table->string('cbiEntity');
            $table->integer('cbiMunicipility_id')->unsigned();
            $table->foreign('cbiMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->string('cbiModalitycontract');
            // LICITACION PUBLICA, SUBASTA INVERSA, MENOR CUANTIA, MINIMA CUANTIA, INVITACION PRIVADA, ESTUDIO DE MERCADO
            $table->text('cbiObjectcontract');
            $table->string('cbiEmail');
            $table->text('cbiObservation');
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
        Schema::dropIfExists('clientbiddings');
    }
}
