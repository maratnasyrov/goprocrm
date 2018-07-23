<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price');
            $table->integer('number');
            $table->string('order_link')->nullable();
            $table->string('order_number')->nullable();
            $table->string('order_provider')->nullable();
            $table->string('order_status')->nullable();
            $table->float('order_payment')->nullable();
            $table->string('order_payment_type')->nullable();
            $table->string('order_payment_status')->nullable();
            $table->string('order_comment')->nullable();
            $table->string('delivery_tracker')->nullable();
            $table->string('delivery_company')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('delivery_place')->nullable();
            $table->string('delivery_payment')->nullable();
            $table->string('delivery_comment')->nullable();
            $table->integer('tender_id');
            $table->integer('manager_id')->nullable();
            $table->integer('storekeeper_id')->nullable();
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
        Schema::dropIfExists('merchandises');
    }
}
