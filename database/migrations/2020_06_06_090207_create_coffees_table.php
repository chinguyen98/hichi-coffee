<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoffeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coffees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->string('info', 3000);
            $table->integer('expired');
            $table->integer('quantity');
            $table->boolean('status');
            $table->integer('id_brand')->unsigned();
            $table->integer('id_coffee_type')->unsigned();
            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('RESTRICT');
            $table->foreign('id_coffee_type')->references('id')->on('coffee_types')->onDelete('RESTRICT');
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
        Schema::dropIfExists('coffees');
    }
}
