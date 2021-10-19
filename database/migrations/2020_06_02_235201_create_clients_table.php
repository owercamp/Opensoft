<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('cliId');
            $table->enum('cliType',['Natural','Jurídica']);
            $table->string('cliNumberdocument');
            $table->string('cliNamereason');
            $table->string('cliNamerepresentative')->nullable();
            $table->string('cliNumberrepresentative')->nullable();
            $table->integer('cliMunicipality_id')->unsigned()->nullable();
            $table->foreign('cliMunicipality_id')->references('munId')->on('settingmunicipalities');
            $table->string('cliAddress');
            $table->string('cliPhone');
            $table->string('cliMovil');
            $table->string('cliWhatsapp');
            $table->string('cliEmail');
            $table->string('cliPdfrut');
            $table->string('cliPdfphotocopy');
            $table->string('cliPdfexistence')->nullable();
            $table->string('cliPdflegal')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
