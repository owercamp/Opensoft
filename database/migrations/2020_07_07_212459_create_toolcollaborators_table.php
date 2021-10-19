<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toolcollaborators', function (Blueprint $table) {
            $table->increments('tcoId');
            $table->date('tcoDate');
            $table->integer('tcoDocument_id')->unsigned();
            $table->foreign('tcoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('tcoDocumentcode')->nullable();
            $table->integer('tcoLegalization_id')->unsigned()->nullable();
            $table->foreign('tcoLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->text('tcoDelivery');
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
        Schema::dropIfExists('toolcollaborators');
    }
}
