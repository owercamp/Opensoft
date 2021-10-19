<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsimprovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsimprovement', function (Blueprint $table) {
            $table->Increments('doIId');
            $table->string('doIName', 50);
            $table->string('doICode', 14);
            $table->string('doIVersion', 4);
            $table->date('doIDate');
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
        Schema::dropIfExists('documentsimprovement');
    }
}
