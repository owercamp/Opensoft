<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingneighborhoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingneighborhoods', function (Blueprint $table) {
            $table->increments('neId');
            $table->string('neName',50);
            $table->integer('neCode');
            $table->integer('neZoning_id')->unsigned();
            $table->foreign('neZoning_id')->references('zonId')->on('settingzonings');
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
        Schema::dropIfExists('settingneighborhoods');
    }
}
