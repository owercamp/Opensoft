<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('typeservices', 150);
            $table->unsignedInteger('origin');
            $table->unsignedInteger('destiny');
            $table->string('collaborator', 150);
            $table->enum('stars', ['Estrella 1', 'Estrella 2', 'Estrella 3', 'Estrella 4', 'Estrella 5'])->nullable();
            $table->text('comments', 500)->nullable();
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
        Schema::dropIfExists('customer_ratings');
    }
}
