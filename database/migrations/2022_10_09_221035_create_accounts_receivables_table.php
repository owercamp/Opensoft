<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_receivables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('typeservices', 150);
            $table->unsignedInteger('origin');
            $table->unsignedInteger('destiny');
            $table->string('collaborator', 150);
            $table->bigInteger('price')->autoIncrement(false);
            $table->foreign('origin')->references('munId')->on('settingmunicipalities');
            $table->foreign('destiny')->references('munId')->on('settingmunicipalities');
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
        Schema::dropIfExists('accounts_receivables');
    }
}
