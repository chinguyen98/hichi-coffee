<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('input_count');
            $table->boolean('status');
            $table->integer('id_coffee')->unsigned();
            $table->integer('id_unit')->unsigned();
            $table->integer('id_input')->unsigned();
            $table->foreign('id_coffee')->references('id')->on('coffees')->onDelete('RESTRICT');
            $table->foreign('id_unit')->references('id')->on('units')->onDelete('RESTRICT');
            $table->foreign('id_input')->references('id')->on('inputs')->onDelete('RESTRICT');
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
        Schema::dropIfExists('input_details');
    }
}
