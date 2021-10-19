<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomotorschargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automotorscharge', function (Blueprint $table) {
            $table->increments('aucId');
            $table->string('aucPhone',10);
            $table->string('aucTypevehicle');
            $table->string('aucPlate',10);
            $table->string('aucBrand',10);
            $table->string('aucModel',4);
            $table->integer('aucContractormessenger_id')->unsigned();
            $table->foreign('aucContractormessenger_id')->references('cmId')->on('contractorsmessenger');
            $table->string('aucContractormessengers',200);
            $table->string('aucPhotofront');
            $table->string('aucPhotoside');
            $table->string('aucPhotoback');
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
        Schema::dropIfExists('automotorscharge');
    }
}
