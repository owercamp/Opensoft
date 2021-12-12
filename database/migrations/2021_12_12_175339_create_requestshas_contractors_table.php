<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestshasContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestshas_contractors', function (Blueprint $table) {
            $table->Increments('rc_id');
            $table->integer('rc_request')->comment("este id se relaciona con el id de la tabla correspondiente segun tipo de servicio 'requestcharges, requestlogistics, requestmessengers, requestturisms, request_urban_transfers, request_intermunity_transfers'");
            $table->integer('rc_contractor')->comment("este id se relaciona con el id de la tabla correspondiente segun tipo de servicio 'contractorschargeexpress, contractorsmessenger, contractorsserviceespecial'");
            $table->string('rc_type')->comment('tipos de servicio para realizar la consulta a las tablas correspondientes');
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
        Schema::dropIfExists('requestshas_contractors');
    }
}
