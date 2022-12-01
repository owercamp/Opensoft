<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToCustomerRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_ratings', function (Blueprint $table) {
            $table->enum('users',['CLIENTE','OPERARIO'])->default('CLIENTE')->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_ratings', function (Blueprint $table) {
            $table->dropColumn('users');
        });
    }
}
