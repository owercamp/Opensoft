<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcaselogisticexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcaselogisticexpress', function (Blueprint $table) {
            $table->increments('bleId');
            $table->string('bleYear');
            $table->integer('bleMunicipility_id')->unsigned();
            $table->foreign('bleMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->integer('bleTypeservice_id')->unsigned();
            $table->foreign('bleTypeservice_id')->references('slId')->on('settingserviceslogistic');
            $table->integer('bleValueratebase');
            $table->integer('bleValueminutewait');
            $table->integer('bleValuereturn');
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
        Schema::dropIfExists('briefcaselogisticexpress');
    }
}
