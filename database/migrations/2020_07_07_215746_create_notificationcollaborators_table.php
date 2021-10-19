<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationcollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationcollaborators', function (Blueprint $table) {
            $table->increments('ncoId');
            $table->date('ncoDate');
            $table->integer('ncoDocument_id')->unsigned();
            $table->foreign('ncoDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('ncoDocumentcode')->nullable();
            $table->integer('ncoLegalization_id')->unsigned();
            $table->foreign('ncoLegalization_id')->references('bcoId')->on('billcollaborators');
            $table->text('ncoNotification');
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
        Schema::dropIfExists('notificationcollaborators');
    }
}
