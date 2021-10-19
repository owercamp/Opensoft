<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingproductstransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingproductstransfer', function (Blueprint $table) {
            $table->increments('ptrId');
            $table->string('ptrProduct',50);
            $table->string('ptrAvailability',50);
            $table->string('ptrDescription',200);
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
        Schema::dropIfExists('settingproductstransfer');
    }
}
