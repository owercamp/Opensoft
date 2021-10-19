<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorschargeexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractorschargeexpress', function (Blueprint $table) {
            $table->increments('ccId');
            $table->string('ccPhoto',50)->nullable();
            $table->string('ccFirm',50)->nullable();
            $table->string('ccNames',100);
            $table->integer('ccPersonal_id')->unsigned();
            $table->foreign('ccPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('ccNumberdocument',15);
            $table->integer('ccDriving_id')->unsigned();
            $table->foreign('ccDriving_id')->references('driId')->on('settingdrivings');
            $table->string('ccNumberdriving',50);
            $table->integer('ccNeighborhood_id')->unsigned();
            $table->foreign('ccNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('ccAddress',50);
            $table->string('ccBloodtype',20);
            // $table->integer('ccBloodtype_id')->unsigned();
            // $table->foreign('ccBloodtype_id')->references('blId')->on('bloodtypes');
            $table->integer('ccHealths_id')->unsigned();
            $table->foreign('ccHealths_id')->references('heaId')->on('settinghealths');
            $table->integer('ccRisk_id')->unsigned();
            $table->foreign('ccRisk_id')->references('risId')->on('settingrisks');
            $table->integer('ccPension_id')->unsigned();
            $table->foreign('ccPension_id')->references('penId')->on('settingpensions');
            $table->integer('ccLayoff_id')->unsigned();
            $table->foreign('ccLayoff_id')->references('layId')->on('settinglayoffs');
            $table->integer('ccCompensation_id')->unsigned();
            $table->foreign('ccCompensation_id')->references('comId')->on('settingcompensations');
            $table->string('ccEmail',100);
            $table->string('ccMovil',10);
            $table->string('ccWhatsapp',10);
            $table->string('ccCourses',100); // Formato: curso=>fecha,curso=>fecha,curso=>fecha
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
        Schema::dropIfExists('contractorschargeexpress');
    }
}
