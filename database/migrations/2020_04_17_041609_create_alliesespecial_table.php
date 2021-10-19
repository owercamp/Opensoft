<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlliesespecialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliesespecial', function (Blueprint $table) {
            $table->increments('aeId');
            $table->string('aeReasonsocial',50);
            $table->integer('aePersonal_id')->unsigned();
            $table->foreign('aePersonal_id')->references('perId')->on('settingpersonals');
            $table->string('aeNumberdocument',50);
            $table->string('aeNumberregistration',50);
            $table->date('aeDateregistration');
            $table->string('aeCommerce',50);
            $table->integer('aeNeighborhood_id')->unsigned();
            $table->foreign('aeNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('aeAddress',100);
            $table->string('aeEmail',100);
            $table->string('aePhone',10);
            $table->string('aeMovil',10);
            $table->string('aeWhatsapp',10);
            $table->string('aeRepresentativename',50);
            $table->integer('aeRepresentativepersonal_id')->unsigned();
            $table->foreign('aeRepresentativepersonal_id')->references('perId')->on('settingpersonals');
            $table->string('aeRepresentativenumberdocument',50);
            $table->string('aeBank',50);
            $table->string('aeTypeaccount',10);
            $table->string('aeAccountnumber',50);
            $table->string('aeRegime',15);
            $table->string('aeTaxpayer',2);
            $table->string('aeAutoretainer',2);
            $table->string('aeActivitys',20);
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
        Schema::dropIfExists('alliesespecial');
    }
}
