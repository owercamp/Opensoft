<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcasemessengerexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcasemessengerexpress', function (Blueprint $table) {
            $table->increments('bmeId');
            $table->string('bmeYear');
            $table->integer('bmeMunicipility_id')->unsigned();
            $table->foreign('bmeMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->integer('bmeTypeservice_id')->unsigned();
            $table->foreign('bmeTypeservice_id')->references('smId')->on('settingservicesmessenger');
            $table->integer('bmeValueratebase');
            $table->integer('bmeValuekilometres');
            $table->integer('bmeValueminutewait');
            $table->integer('bmeValuereturn');
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
        Schema::dropIfExists('briefcasemessengerexpress');
    }
}
