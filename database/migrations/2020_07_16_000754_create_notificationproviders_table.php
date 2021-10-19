<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationprovidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationproviders', function (Blueprint $table) {
            $table->increments('npId');
            $table->date('npDate');
            $table->integer('npDocument_id')->unsigned();
            $table->foreign('npDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('npDocumentcode')->nullable();
            $table->integer('npBillprovider_id')->unsigned();
            $table->foreign('npBillprovider_id')->references('bpId')->on('billproviders');
            $table->text('npNotification');
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
        Schema::dropIfExists('notificationproviders');
    }
}
