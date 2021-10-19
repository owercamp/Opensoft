<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigdocumentsimprovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configdocumentsimprovement', function (Blueprint $table) {
            $table->Increments('cdiId');
            $table->integer('cdiDocument_id')->unsigned()->nullable();
            $table->foreign('cdiDocument_id')->references('doIId')->on('documentsimprovement');
            $table->text('cdiContent');
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
        Schema::dropIfExists('configdocumentsimprovement');
    }
}
