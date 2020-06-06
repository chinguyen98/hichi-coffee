<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_price');
            $table->integer('id_customer')->unsigned();
            $table->integer('id_admin')->unsigned();
            $table->integer('id_shipping_type')->unsigned();
            $table->integer('id_shipping_address')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('RESTRICT');
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('RESTRICT');
            $table->foreign('id_shipping_type')->references('id')->on('shipping_types')->onDelete('RESTRICT');
            $table->foreign('id_shipping_address')->references('id')->on('shipping_addresses')->onDelete('RESTRICT');
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
}
