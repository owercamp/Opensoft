<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('proId');
            $table->string('proReasonsocial',50);
            $table->integer('proPersonal_id')->unsigned();
            $table->foreign('proPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('proNumberdocument',50);
            $table->string('proNumberregistration',50);
            $table->date('proDateregistration');
            $table->string('proCommerce',50);
            $table->integer('proNeighborhood_id')->unsigned();
            $table->foreign('proNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('proAddress',100);
            $table->string('proEmail',100);
            $table->string('proPhone',10);
            $table->string('proMovil',10);
            $table->string('proWhatsapp',10);
            $table->string('proRepresentativename',50);
            $table->integer('proRepresentativepersonal_id')->unsigned();
            $table->foreign('proRepresentativepersonal_id')->references('perId')->on('settingpersonals');
            $table->string('proRepresentativenumberdocument',50);
            $table->string('proBank',50);
            $table->string('proTypeaccount',10);
            $table->string('proAccountnumber',50);
            $table->string('proRegime',15);
            $table->string('proTaxpayer',2);
            $table->string('proAutoretainer',2);
            $table->string('proActivitys',20);
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
        Schema::dropIfExists('providers');
    }
}
