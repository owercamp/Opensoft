<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomotorsmessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automotorsmessenger', function (Blueprint $table) {
            $table->increments('aumId');
            $table->string('aumPhone',10);
            $table->integer('aumMotorcycle_id')->unsigned();
            $table->foreign('aumMotorcycle_id')->references('motId')->on('settingmotorcycles');
            $table->string('aumPlate',10);
            $table->string('aumBrand',10);
            $table->string('aumModel',4);
            $table->integer('aumContractormessenger_id')->unsigned();
            $table->foreign('aumContractormessenger_id')->references('cmId')->on('contractorsmessenger');
            $table->string('aumContractormessengers',200);
            $table->string('aumPhotofront');
            $table->string('aumPhotoside');
            $table->string('aumPhotoback');
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
        Schema::dropIfExists('automotorsmessenger');
    }
}
