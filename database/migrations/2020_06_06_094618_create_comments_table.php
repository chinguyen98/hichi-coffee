<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_high_comment')->unsigned();
            $table->string('content', 3000);
            $table->boolean('status');
            $table->integer('id_coffee')->unsigned();
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_coffee')->references('id')->on('coffees')->onDelete('RESTRICT');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('RESTRICT');
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
        Schema::dropIfExists('comments');
    }
}
