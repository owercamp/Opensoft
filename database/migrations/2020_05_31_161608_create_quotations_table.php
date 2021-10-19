<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('quoId');
            $table->string('quoType');
            $table->integer('quoBidding_id')->unsigned()->nullable();
            $table->foreign('quoBidding_id')->references('cbiId')->on('clientbiddings');
            $table->integer('quoProposal_id')->unsigned()->nullable();
            $table->foreign('quoProposal_id')->references('cprId')->on('clientproposals');
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
        Schema::dropIfExists('quotations');
    }
}
