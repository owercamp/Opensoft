<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcasechargeexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcasechargeexpress', function (Blueprint $table) {
            $table->increments('bceId');
            $table->string('bceYear');
            $table->integer('bceMunicipility_id')->unsigned();
            $table->foreign('bceMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->integer('bceTypevehicle_id')->unsigned();
            $table->foreign('bceTypevehicle_id')->references('heaId')->on('settingheavys');
            $table->integer('bceTypeservice_id')->unsigned();
            $table->foreign('bceTypeservice_id')->references('scId')->on('settingservicescharge');
            $table->integer('bceValueratebase');
            $table->integer('bceValuekilometres');
            $table->integer('bceValuereturn');
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
        Schema::dropIfExists('briefcasechargeexpress');
    }
}
