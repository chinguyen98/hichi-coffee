<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('bonus')->nullable();
            $table->boolean('status');
            $table->dateTime('expired');
            $table->integer('id_coffee')->unsigned();
            $table->integer('id_unit')->unsigned();
            $table->integer('id_quantity')->unsigned();
            $table->foreign('id_coffee')->references('id')->on('coffees')->onDelete('RESTRICT');
            $table->foreign('id_unit')->references('id')->on('units')->onDelete('RESTRICT');
            $table->foreign('id_quantity')->references('id')->on('quantities')->onDelete('RESTRICT');
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
        Schema::dropIfExists('valuations');
    }
}
