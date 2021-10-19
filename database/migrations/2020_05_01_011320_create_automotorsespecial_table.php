<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomotorsespecialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automotorsespecial', function (Blueprint $table) {
            $table->increments('aueId');
            $table->string('auePhone',10);
            $table->integer('aueTypevehicle_id')->unsigned();
            $table->foreign('aueTypevehicle_id')->references('espId')->on('settingespecials');
            $table->string('auePlate',10);
            $table->string('aueBrand',10);
            $table->string('aueModel',4);
            $table->integer('aueAlliesespecial_id')->unsigned();
            $table->foreign('aueAlliesespecial_id')->references('aeId')->on('alliesespecial');
            $table->integer('aueContractorespecial_id')->unsigned();
            $table->foreign('aueContractorespecial_id')->references('ceId')->on('contractorsserviceespecial');
            $table->string('aueContractorespecials',200);
            $table->string('auePhotofront');
            $table->string('auePhotoside');
            $table->string('auePhotoback');
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
        Schema::dropIfExists('automotorsespecial');
    }
}
