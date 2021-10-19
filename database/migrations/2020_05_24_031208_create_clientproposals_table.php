<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientproposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientproposals', function (Blueprint $table) {
            $table->increments('cprId');
            $table->date('cprDate');
            $table->string('cprClient');
            $table->integer('cprTypedocument_id')->unsigned();
            $table->foreign('cprTypedocument_id')->references('perId')->on('settingpersonals');
            $table->string('cprNumberdocument');
            $table->integer('cprMunicipility_id')->unsigned();
            $table->foreign('cprMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->string('cprModalitycontract');
            // LICITACION PUBLICA, SUBASTA INVERSA, MENOR CUANTIA, MINIMA CUANTIA, INVITACION PRIVADA, ESTUDIO DE MERCADO
            $table->string('cprEmail');
            $table->string('cprPhone');
            $table->string('cprContact');
            $table->text('cprObservation');
            $table->text('cprBriefcase');
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
        Schema::dropIfExists('clientproposals');
    }
}
