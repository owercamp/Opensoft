<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configdocuments', function (Blueprint $table) {
            $table->increments('cdoId');
            $table->integer('cdoDocument_id')->unsigned()->nullable();
            $table->foreign('cdoDocument_id')->references('docId')->on('documents');
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
        Schema::dropIfExists('configdocuments');
    }
}
