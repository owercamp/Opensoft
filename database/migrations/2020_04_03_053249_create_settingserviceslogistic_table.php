<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingserviceslogisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingserviceslogistic', function (Blueprint $table) {
            $table->increments('slId');
            $table->integer('slProduct_id')->unsigned();
            $table->foreign('slProduct_id')->references('plId')->on('settingproductslogistic');
            $table->string('slService',50);
            $table->string('slAvailability',50);
            $table->string('slDescription',200);
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
        Schema::dropIfExists('settingserviceslogistic');
    }
}
