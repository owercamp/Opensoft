<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllieschargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliescharge', function (Blueprint $table) {
            $table->increments('acId');
            $table->string('acReasonsocial',50);
            $table->integer('acPersonal_id')->unsigned();
            $table->foreign('acPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('acNumberdocument',50);
            $table->string('acNumberregistration',50);
            $table->date('acDateregistration');
            $table->string('acCommerce',50);
            $table->integer('acNeighborhood_id')->unsigned();
            $table->foreign('acNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('acAddress',100);
            $table->string('acEmail',100);
            $table->string('acPhone',10);
            $table->string('acMovil',10);
            $table->string('acWhatsapp',10);
            $table->string('acRepresentativename',50);
            $table->integer('acRepresentativepersonal_id')->unsigned();
            $table->foreign('acRepresentativepersonal_id')->references('perId')->on('settingpersonals');
            $table->string('acRepresentativenumberdocument',50);
            $table->string('acBank',50);
            $table->string('acTypeaccount',10);
            $table->string('acAccountnumber',50);
            $table->string('acRegime',15);
            $table->string('acTaxpayer',2);
            $table->string('acAutoretainer',2);
            $table->string('acActivitys',20);
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
        Schema::dropIfExists('alliescharge');
    }
}
