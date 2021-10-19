<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlliesmessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliesmessenger', function (Blueprint $table) {
            $table->increments('amId');
            $table->string('amReasonsocial',50);
            $table->integer('amPersonal_id')->unsigned();
            $table->foreign('amPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('amNumberdocument',50);
            $table->string('amNumberregistration',50);
            $table->date('amDateregistration');
            $table->string('amCommerce',50);
            $table->integer('amNeighborhood_id')->unsigned();
            $table->foreign('amNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('amAddress',100);
            $table->string('amEmail',100);
            $table->string('amPhone',10);
            $table->string('amMovil',10);
            $table->string('amWhatsapp',10);
            $table->string('amRepresentativename',50);
            $table->integer('amRepresentativepersonal_id')->unsigned();
            $table->foreign('amRepresentativepersonal_id')->references('perId')->on('settingpersonals');
            $table->string('amRepresentativenumberdocument',50);
            $table->string('amBank',50);
            $table->string('amTypeaccount',10);
            $table->string('amAccountnumber',50);
            $table->string('amRegime',15);
            $table->string('amTaxpayer',2);
            $table->string('amAutoretainer',2);
            $table->string('amActivitys',20);
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
        Schema::dropIfExists('alliesmessenger');
    }
}
