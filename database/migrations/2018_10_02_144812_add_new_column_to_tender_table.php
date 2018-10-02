<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToTenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->string('contract_number')->nullable();
            $table->string('contract_date')->nullable();
            $table->string('contract_status')->nullable();
            $table->string('problem')->nullable();
            $table->string('processing_payment')->nullable();
            $table->string('manager_payment')->nullable();
            $table->string('courier_payment')->nullable();
            $table->string('status')->nullable();
            $table->string('documents_status')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('invoice_date')->nullable();
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
            $table->dropColumn('contract_number');
            $table->dropColumn('contract_date');
            $table->dropColumn('contract_status');
            $table->dropColumn('problem');
            $table->dropColumn('processing_payment');
            $table->dropColumn('manager_payment');
            $table->dropColumn('courier_payment');
            $table->dropColumn('status');
            $table->dropColumn('documents_status');
            $table->dropColumn('delivery_status');
            $table->dropColumn('invoice_date');
        });
    }
}
