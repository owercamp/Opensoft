<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcasetransferexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcasetransferexpress', function (Blueprint $table) {
            $table->increments('btreId');
            $table->string('btreYear');
            $table->integer('btreMunicipility_id')->unsigned();
            $table->foreign('btreMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->integer('btreTypevehicle_id')->unsigned();
            $table->foreign('btreTypevehicle_id')->references('espId')->on('settingespecials');
            $table->integer('btreTypeservice_id')->unsigned();
            $table->foreign('btreTypeservice_id')->references('strId')->on('settingservicestransfer');
            $table->integer('btreValueratebase');
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
        Schema::dropIfExists('briefcasetransferexpress');
    }
}
