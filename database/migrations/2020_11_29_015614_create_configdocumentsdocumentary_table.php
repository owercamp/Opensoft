<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigdocumentsdocumentaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configdocumentsdocumentary', function (Blueprint $table) {
            $table->Increments('cddId');
            $table->integer('cddDocument_id')->unsigned()->nullable();
            $table->foreign('cddDocument_id')->references('dodId')->on('documentsdocumentary');
            $table->text('cddContent');
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
        Schema::dropIfExists('configdocumentsdocumentary');
    }
}
