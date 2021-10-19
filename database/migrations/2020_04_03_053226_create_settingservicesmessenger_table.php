<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingservicesmessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingservicesmessenger', function (Blueprint $table) {
            $table->increments('smId');
            $table->integer('smProduct_id')->unsigned();
            $table->foreign('smProduct_id')->references('pmId')->on('settingproductsmessenger');
            $table->string('smService',50);
            $table->string('smAvailability',50);
            $table->string('smDescription',200);
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
        Schema::dropIfExists('settingservicesmessenger');
    }
}
