<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('terId');
            $table->integer('terLegalization_id')->unsigned()->nullable();
            $table->foreign('terLegalization_id')->references('lcoId')->on('legalizationscontractual');
            $table->date('terDateinitial');
            $table->date('terDatefinal');
            $table->string('terBriefcase');
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
        Schema::dropIfExists('terms');
    }
}
