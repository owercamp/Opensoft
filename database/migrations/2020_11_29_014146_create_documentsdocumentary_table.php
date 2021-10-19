<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsdocumentaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsdocumentary', function (Blueprint $table) {
            $table->Increments('dodId');
            $table->string('dodName', 50);
            $table->string('dodCode', 14);
            $table->string('dodVersion', 4);
            $table->date('dodDate');
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
        Schema::dropIfExists('documentsdocumentary');
    }
}
