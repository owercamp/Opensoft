<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingservicesturismTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingservicesturism', function (Blueprint $table) {
            $table->increments('stId');
            $table->integer('stProduct_id')->unsigned();
            $table->foreign('stProduct_id')->references('ptId')->on('settingproductsturism');
            $table->string('stService',50);
            $table->string('stAvailability',50);
            $table->string('stDescription',200);
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
        Schema::dropIfExists('settingservicesturism');
    }
}
