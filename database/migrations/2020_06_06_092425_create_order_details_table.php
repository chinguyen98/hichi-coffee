<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total_sub_price');
            $table->integer('id_coffee')->unsigned();
            $table->integer('id_order')->unsigned();
            $table->integer('id_valuation')->unsigned();
            $table->foreign('id_coffee')->references('id')->on('coffees')->onDelete('RESTRICT');
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('RESTRICT');
            $table->foreign('id_valuation')->references('id')->on('valuations')->onDelete('RESTRICT');
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
        Schema::dropIfExists('order_details');
    }
}
