<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingtechnicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingtechnicals', function (Blueprint $table) {
            $table->increments('teId');
            $table->string('teResolutiontransport',50);
            $table->date('teDateresolutiontransport');
            $table->string('teResolutioncapacity',50);
            $table->date('teDateresolutioncapacity');
            $table->string('teCertificate',200);
            $table->string('teNoteonecertificate',50);
            $table->string('teNotetwocertificate',50);
            $table->string('teCodeqr');
            $table->string('teLogotransport');
            $table->string('teLogocompany');
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
        Schema::dropIfExists('settingtechnicals');
    }
}
