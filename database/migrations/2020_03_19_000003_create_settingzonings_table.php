<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingzoningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingzonings', function (Blueprint $table) {
            $table->increments('zonId');
            $table->string('zonName',50);
            $table->integer('zonMunicipality_id')->unsigned();
            $table->foreign('zonMunicipality_id')->references('munId')->on('settingmunicipalities');
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
        Schema::dropIfExists('settingzonings');
    }
}
