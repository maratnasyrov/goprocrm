<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('address_last_day')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->float('contract_price')->nullable();
            $table->float('ensuring_order')->nullable();
            $table->float('ensuring_contract')->nullable();
            $table->float('delivery_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('address_last_day');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('contract_price');
            $table->dropColumn('ensuring_order');
            $table->dropColumn('ensuring_contract');
            $table->dropColumn('delivery_time');
        });
    }
}