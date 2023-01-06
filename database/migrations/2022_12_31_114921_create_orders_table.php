<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('invoice');
            $table->integer('total');
            $table->string('snap_token');
            $table->string('transaction_status');
            $table->string('order_status');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street');
            $table->string('detailstreet')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('phone');
            $table->string('email');
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
        Schema::dropIfExists('orders');
    }
};
