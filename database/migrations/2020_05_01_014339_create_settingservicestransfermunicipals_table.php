<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingservicestransfermunicipalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingservicestransfermunicipals', function (Blueprint $table) {
            $table->increments('stmId');
            $table->integer('stmTypeproduct_id')->unsigned();
            $table->foreign('stmTypeproduct_id')->references('ptmId')->on('settingproductstransfermunicipals');
            $table->string('stmService');
            $table->string('stmTimeavailability');
            $table->integer('stmMunstart_id')->unsigned();
            $table->foreign('stmMunstart_id')->references('munId')->on('settingmunicipalities');
            $table->string('stmMunicipilityends');
            $table->integer('stmKilometres');
            $table->string('stmDescription',200);
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
        Schema::dropIfExists('settingservicestransfermunicipals');
    }
}
