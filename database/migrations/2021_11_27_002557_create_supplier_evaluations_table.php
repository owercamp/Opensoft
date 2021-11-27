<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_evaluations', function (Blueprint $table) {
            $table->Increments('su_id');
            $table->date('su_date');
            $table->integer('su_provider')->unsigned()->comment('esta es la llave foranea con la tabla providers el campo proId');
            $table->enum('su_status',['CUMPLE','NO CUMPLE']);
            $table->text('su_comment',500);
            $table->foreign('su_provider')->references('proId')->on('providers');
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
        Schema::dropIfExists('supplier_evaluations');
    }
}
