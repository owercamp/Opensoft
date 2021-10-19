<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingespecialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingespecials', function (Blueprint $table) {
            $table->increments('espId');
            $table->string('espTypology',50);
            $table->integer('espPassengers');
            $table->integer('espDisplacement');
            $table->string('espTransmission',5);
            $table->string('espDescription',100);
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
        Schema::dropIfExists('settingespecials');
    }
}
