<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingserviceschargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingservicescharge', function (Blueprint $table) {
            $table->increments('scId');
            $table->integer('scTypeproduct_id')->unsigned();
            $table->foreign('scTypeproduct_id')->references('pcId')->on('settingproductscharge');
            $table->string('scService');
            $table->integer('scUnit');
            $table->integer('scKilos');
            $table->string('scDimensions');
            $table->string('scDescription',200);
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
        Schema::dropIfExists('settingservicescharge');
    }
}
