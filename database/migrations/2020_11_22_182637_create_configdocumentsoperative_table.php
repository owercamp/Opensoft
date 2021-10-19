<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigdocumentsoperativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configdocumentsoperative', function (Blueprint $table) {
            $table->Increments('cdoId');
            $table->integer('cdoDocument_id')->unsigned()->nullable();
            $table->foreign('cdoDocument_id')->references('doOId')->on('documentsoperative');
            $table->text('cdoContent');
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
        Schema::dropIfExists('configdocumentsoperative');
    }
}
