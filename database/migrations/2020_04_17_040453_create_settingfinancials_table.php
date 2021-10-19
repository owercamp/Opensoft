<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingfinancialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingfinancials', function (Blueprint $table) {
            $table->increments('fiId');
            $table->string('fiRegime',15);
            $table->string('fiTaxpayer',2);
            $table->string('fiAutoretainer',2);
            $table->string('fiActivitys',20);
            $table->string('fiResolutionfacturation',50);
            $table->date('fiDateresolutionfacturation');
            $table->integer('fiMountcountresolution');
            $table->date('fiDatefallresolution');
            $table->string('fiPrefix',6);
            $table->integer('fiNumberinitial');
            $table->integer('fiNumberfinal');
            // DATOS DE BANCO Y CUENTA
            $table->string('fiBank',50);
            $table->string('fiBanklogo',50);
            $table->string('fiTypeaccount',10);
            $table->string('fiAccountnumber',50);
            $table->text('fiNotesone',500);
            $table->text('fiNotestwo',500);
            // NUMERACION INICIAL
            $table->integer('fiNumberinitialfacturation');
            $table->integer('fiNumberinitialvoucherentry');
            $table->integer('fiNumberinitialvoucheregress');
            // INDICADORES FINANCIEROS
            $table->string('fiCapitalwork',15);
            $table->string('fiHeritage',15);
            $table->double('fiIndexsettlement',4,2);
            $table->double('fiIndexdebt',4,2);
            $table->double('fiReasoncoverage',4,2);
            $table->double('fiProfitabilityheritage',4,2);
            $table->double('fiProfitabilityactives',4,2);
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
        Schema::dropIfExists('settingfinancials');
    }
}
