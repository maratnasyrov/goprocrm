<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_full');
            $table->string('name_short')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('inn')->nullable();
            $table->string('kpp')->nullable();
            $table->string('okpo')->nullable();
            $table->string('ogrn')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
