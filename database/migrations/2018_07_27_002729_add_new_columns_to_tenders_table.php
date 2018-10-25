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
            $table->string('name', 500)->nullable();
            $table->string('address')->nullable();
            $table->string('address_last_day')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('contract_price')->nullable();
            $table->string('ensuring_order')->nullable();
            $table->string('ensuring_contract')->nullable();
            $table->integer('delivery_time')->nullable();
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
            $table->dropColumn('name');
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
