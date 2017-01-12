<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaEntradaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_entrada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned(); 
            $table->integer('horarios_id')->unsigned(); 
            $table->integer('bus_id')->unsigned(); 
            $table->string('estado')->nullable();
            $table->timestamps();
        });

        Schema::table('reserva_entrada', function($table) {
           $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('horarios_id')->references('id')->on('horarios')->onDelete('cascade');
           $table->foreign('bus_id')->references('id')->on('bus')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reserva_entrada');
    }
}
