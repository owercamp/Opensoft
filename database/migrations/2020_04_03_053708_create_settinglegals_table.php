<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettinglegalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settinglegals', function (Blueprint $table) {
            $table->increments('leId');
            $table->string('leReasonsocial',50);
            $table->integer('lePersonal_id')->unsigned();
            $table->foreign('lePersonal_id')->references('perId')->on('settingpersonals');
            $table->string('leNumberdocument',50);
            $table->string('leNumberregistration',50);
            $table->date('leDateregistration');
            $table->string('leCommerce',50);
            $table->integer('leNeighborhood_id')->unsigned();
            $table->foreign('leNeighborhood_id')->references('neId')->on('settingneighborhoods');
            $table->string('leAddress',50);
            $table->string('leEmail',100);
            $table->string('lePhone',10);
            $table->string('leMovil',10);
            $table->string('leWhatsapp',10);
            $table->string('leRepresentativename',50);
            $table->integer('leRepresentativepersonal_id')->unsigned();
            $table->foreign('leRepresentativepersonal_id')->references('perId')->on('settingpersonals');
            $table->string('leRepresentativenumberdocument',50);
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
        Schema::dropIfExists('settinglegals');
    }
}
