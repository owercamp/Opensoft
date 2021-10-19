<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcaseturismexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcaseturismexpress', function (Blueprint $table) {
            $table->increments('bteId');
            $table->string('bteYear');
            $table->integer('bteMunicipility_id')->unsigned();
            $table->foreign('bteMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->integer('bteTypevehicle_id')->unsigned();
            $table->foreign('bteTypevehicle_id')->references('espId')->on('settingespecials');
            $table->integer('bteTypeservice_id')->unsigned();
            $table->foreign('bteTypeservice_id')->references('stId')->on('settingservicesturism');
            $table->integer('bteValueratebase');
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
        Schema::dropIfExists('briefcaseturismexpress');
    }
}
