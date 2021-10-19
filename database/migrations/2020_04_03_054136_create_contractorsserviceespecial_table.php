<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsserviceespecialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractorsserviceespecial', function (Blueprint $table) {
            $table->increments('ceId');
            $table->string('cePhoto',50)->nullable();
            $table->string('ceFirm',50)->nullable();
            $table->string('ceNames',100);
            $table->integer('cePersonal_id')->unsigned();
            $table->foreign('cePersonal_id')->references('perId')->on('settingpersonals');
            $table->string('ceNumberdocument',15);
            $table->integer('ceDriving_id')->unsigned();
            $table->foreign('ceDriving_id')->references('driId')->on('settingdrivings');
            $table->string('ceNumberdriving',50);
            $table->integer('ceNeighborhood_id')->unsigned();
            $table->foreign('ceNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('ceAddress',50);
            $table->string('ceBloodtype',20);
            // $table->integer('ceBloodtype_id')->unsigned();
            // $table->foreign('ceBloodtype_id')->references('blId')->on('bloodtypes');
            $table->integer('ceHealths_id')->unsigned();
            $table->foreign('ceHealths_id')->references('heaId')->on('settinghealths');
            $table->integer('ceRisk_id')->unsigned();
            $table->foreign('ceRisk_id')->references('risId')->on('settingrisks');
            $table->integer('cePension_id')->unsigned();
            $table->foreign('cePension_id')->references('penId')->on('settingpensions');
            $table->integer('ceLayoff_id')->unsigned();
            $table->foreign('ceLayoff_id')->references('layId')->on('settinglayoffs');
            $table->integer('ceCompensation_id')->unsigned();
            $table->foreign('ceCompensation_id')->references('comId')->on('settingcompensations');
            $table->string('ceEmail',100);
            $table->string('ceMovil',10);
            $table->string('ceWhatsapp',10);
            $table->string('ceCourses',100); // Formato: curso=>fecha,curso=>fecha,curso=>fecha
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
        Schema::dropIfExists('contractorsserviceespecial');
    }
}
