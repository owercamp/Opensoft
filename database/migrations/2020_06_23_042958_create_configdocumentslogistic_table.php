<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigdocumentslogisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configdocumentslogistic', function (Blueprint $table) {
            $table->increments('cdlId');
            $table->integer('cdlDocument_id')->unsigned()->nullable();
            $table->foreign('cdlDocument_id')->references('dolId')->on('documentslogistic');
            $table->text('cdlContent');
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
        Schema::dropIfExists('configdocumentslogistic');
    }
}
