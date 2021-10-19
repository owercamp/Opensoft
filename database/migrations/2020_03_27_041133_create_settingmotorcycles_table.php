<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingmotorcyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingmotorcycles', function (Blueprint $table) {
            $table->increments('motId');
            $table->string('motTypology',50);
            $table->integer('motDisplacement');
            $table->integer('motTimes');
            $table->string('motDescription',100);
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
        Schema::dropIfExists('settingmotorcycles');
    }
}
