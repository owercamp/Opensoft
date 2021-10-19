<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsmanagerialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsmanagerial', function (Blueprint $table) {
            $table->Increments('domId');
            $table->string('domName', 50);
            $table->string('domCode', 14);            
            $table->string('domVersion', 4);
            $table->date('domDate');
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
        Schema::dropIfExists('documentsmanagerial');
    }
}
