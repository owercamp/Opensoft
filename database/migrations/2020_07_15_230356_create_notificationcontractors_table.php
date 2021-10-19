<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationcontractors', function (Blueprint $table) {
            $table->increments('ncId');
            $table->date('ncDate');
            $table->integer('ncDocument_id')->unsigned();
            $table->foreign('ncDocument_id')->references('dolId')->on('documentslogistic');
            $table->string('ncDocumentcode')->nullable();
            $table->integer('ncBillcontractor_id')->unsigned();
            $table->foreign('ncBillcontractor_id')->references('bcId')->on('billcontractors');
            $table->text('ncNotification');
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
        Schema::dropIfExists('notificationcontractors');
    }
}
