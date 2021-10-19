<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketings', function (Blueprint $table) {
            $table->increments('marId');
            $table->date('marDate');
            $table->string('marReason');
            $table->integer('marMunicipility_id')->unsigned();
            $table->foreign('marMunicipility_id')->references('munId')->on('settingmunicipalities');
            $table->string('marAddress');
            $table->string('marContact');
            $table->string('marPhone');
            $table->string('marEmail');
            $table->text('marObservation');
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
        Schema::dropIfExists('marketings');
    }
}
