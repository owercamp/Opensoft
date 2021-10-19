<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingmunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingmunicipalities', function (Blueprint $table) {
            $table->increments('munId');
            $table->string('munName',50);
            $table->integer('munDepartment_id')->unsigned();
            $table->foreign('munDepartment_id')->references('depId')->on('settingdepartments');
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
        Schema::dropIfExists('settingmunicipalities');
    }
}
