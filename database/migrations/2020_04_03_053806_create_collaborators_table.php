<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->increments('coId');
            $table->string('coPhoto',50)->nullable();
            $table->string('coFirm',50)->nullable();
            $table->string('coNames',100);
            $table->integer('coPersonal_id')->unsigned();
            $table->foreign('coPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('coNumberdocument',15);
            $table->string('coPosition',50);
            $table->integer('coNeighborhood_id')->unsigned();
            $table->foreign('coNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('coAddress',50);
            $table->string('coBloodtype',20);
            // $table->integer('coBloodtype_id')->unsigned();
            // $table->foreign('coBloodtype_id')->references('blId')->on('bloodtypes');
            $table->integer('coHealths_id')->unsigned();
            $table->foreign('coHealths_id')->references('heaId')->on('settinghealths');
            $table->integer('coRisk_id')->unsigned();
            $table->foreign('coRisk_id')->references('risId')->on('settingrisks');
            $table->integer('coPension_id')->unsigned();
            $table->foreign('coPension_id')->references('penId')->on('settingpensions');
            $table->integer('coLayoff_id')->unsigned();
            $table->foreign('coLayoff_id')->references('layId')->on('settinglayoffs');
            $table->integer('coCompensation_id')->unsigned();
            $table->foreign('coCompensation_id')->references('comId')->on('settingcompensations');
            $table->string('coEmail',100);
            $table->string('coMovil',10);
            $table->string('coWhatsapp',10);
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
        Schema::dropIfExists('collaborators');
    }
}
