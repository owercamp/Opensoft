<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcasetransferintermunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcasetransferintermunicipalities', function (Blueprint $table) {
            $table->increments('btriId');
            $table->string('btriYear');
            $table->integer('btriTypevehicle_id')->unsigned();
            $table->foreign('btriTypevehicle_id')->references('espId')->on('settingespecials');
            $table->integer('btriTypeservice_id')->unsigned();
            $table->foreign('btriTypeservice_id')->references('stmId')->on('settingservicestransfermunicipals');
            $table->integer('btriTime');
            $table->integer('btriKilometres');
            $table->integer('btriValuebase');
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
        Schema::dropIfExists('briefcasetransferintermunicipalities');
    }
}
