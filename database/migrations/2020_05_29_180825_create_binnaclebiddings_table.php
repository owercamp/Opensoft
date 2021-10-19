<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclebiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnaclebiddings', function (Blueprint $table) {
            $table->increments('bbId');
            $table->date('bbDate');
            $table->string('bbObservation');
            $table->integer('bbClientbidding_id')->unsigned();
            $table->foreign('bbClientbidding_id')->references('cbiId')->on('clientbiddings');
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
        Schema::dropIfExists('binnaclebiddings');
    }
}
