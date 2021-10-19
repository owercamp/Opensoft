<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingheavysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingheavys', function (Blueprint $table) {
            $table->increments('heaId');
            $table->string('heaTypology',50);
            $table->integer('heaDisplacement');
            $table->string('heaCapacity',50);
            $table->string('heaDescription',100);
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
        Schema::dropIfExists('settingheavys');
    }
}
