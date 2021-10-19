<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsmessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractorsmessenger', function (Blueprint $table) {
            $table->increments('cmId');
            $table->string('cmPhoto',50)->nullable();
            $table->string('cmFirm',50)->nullable();
            $table->string('cmNames',100);
            $table->integer('cmPersonal_id')->unsigned();
            $table->foreign('cmPersonal_id')->references('perId')->on('settingpersonals');
            $table->string('cmNumberdocument',15);
            $table->integer('cmDriving_id')->unsigned();
            $table->foreign('cmDriving_id')->references('driId')->on('settingdrivings');
            $table->string('cmNumberdriving',50);
            $table->integer('cmNeighborhood_id')->unsigned();
            $table->foreign('cmNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('cmAddress',50);
            $table->string('cmBloodtype',20);
            // $table->integer('cmBloodtype_id')->unsigned();
            // $table->foreign('cmBloodtype_id')->references('blId')->on('bloodtypes');
            $table->integer('cmHealths_id')->unsigned();
            $table->foreign('cmHealths_id')->references('heaId')->on('settinghealths');
            $table->integer('cmRisk_id')->unsigned();
            $table->foreign('cmRisk_id')->references('risId')->on('settingrisks');
            $table->integer('cmPension_id')->unsigned();
            $table->foreign('cmPension_id')->references('penId')->on('settingpensions');
            $table->integer('cmLayoff_id')->unsigned();
            $table->foreign('cmLayoff_id')->references('layId')->on('settinglayoffs');
            $table->integer('cmCompensation_id')->unsigned();
            $table->foreign('cmCompensation_id')->references('comId')->on('settingcompensations');
            $table->string('cmEmail',100);
            $table->string('cmMovil',10);
            $table->string('cmWhatsapp',10);
            $table->string('cmCourses',100); // Formato: curso=>fecha,curso=>fecha,curso=>fecha
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
        Schema::dropIfExists('contractorsmessenger');
    }
}
