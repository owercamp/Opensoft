<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingservicestransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingservicestransfer', function (Blueprint $table) {
            $table->increments('strId');
            $table->integer('strProduct_id')->unsigned();
            $table->foreign('strProduct_id')->references('ptrId')->on('settingproductstransfer');
            $table->string('strService',50);
            $table->string('strAvailability',50);
            $table->string('strDescription',200);
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
        Schema::dropIfExists('settingservicestransfer');
    }
}
