<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsoperativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsoperative', function (Blueprint $table) {
            $table->Increments('doOId');
            $table->string('doOName', 50);
            $table->string('doOCode', 14);
            $table->string('doOVersion', 4);
            $table->date('doODate');
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
        Schema::dropIfExists('documentsoperative');
    }
}
