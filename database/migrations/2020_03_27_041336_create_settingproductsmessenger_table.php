<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingproductsmessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingproductsmessenger', function (Blueprint $table) {
            $table->increments('pmId');
            $table->string('pmProduct',50);
            $table->string('pmAvailability',50);
            $table->string('pmDescription',200);
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
        Schema::dropIfExists('settingproductsmessenger');
    }
}
