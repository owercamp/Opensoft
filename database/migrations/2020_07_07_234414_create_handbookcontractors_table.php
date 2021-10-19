<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandbookcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handbookcontractors', function (Blueprint $table) {
            $table->increments('hcId');
            $table->integer('hcDocument_id')->unsigned()->nullable();
            $table->foreign('hcDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('hcDocumentcode');
            $table->integer('hcConfigdocument_id')->unsigned()->nullable();
            $table->foreign('hcConfigdocument_id')->references('cdlId')->on('configdocumentslogistic');
            $table->text('hcContentfinal');
            $table->text('hcWrited');
            $table->enum('hcStatus',['VIGENTE','TERMINADO'])->default('VIGENTE');
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
        Schema::dropIfExists('handbookcontractors');
    }
}
