<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclemarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnaclemarketings', function (Blueprint $table) {
            $table->increments('bmId');
            $table->date('bmDate');
            $table->string('bmObservation');
            $table->integer('bmMarketing_id')->unsigned();
            $table->foreign('bmMarketing_id')->references('marId')->on('marketings');
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
        Schema::dropIfExists('binnaclemarketings');
    }
}
