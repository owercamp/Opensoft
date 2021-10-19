<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalizationscontractualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legalizationscontractual', function (Blueprint $table) {
            $table->increments('lcoId');
            $table->integer('lcoDocument_id')->unsigned()->nullable();
            $table->foreign('lcoDocument_id')->references('docId')->on('documents');
            $table->integer('lcoClient_id')->unsigned()->nullable();
            $table->foreign('lcoClient_id')->references('cliId')->on('clients');
            $table->integer('lcoConfigdocument_id')->unsigned()->nullable();
            $table->foreign('lcoConfigdocument_id')->references('cdoId')->on('configdocuments');
            $table->text('lcoContentfinal');
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
        Schema::dropIfExists('legalizationscontractual');
    }
}
