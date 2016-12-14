<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('salida');
            $table->integer('cuota')->nullable();
            $table->integer('disponibles')->nullable();
            $table->integer('rutas_id')->unsigned();  
            $table->integer('estado')->nullable();     
            $table->timestamps();
        });

        Schema::table('horarios', function($table) {
           $table->foreign('rutas_id')->references('id')->on('rutas')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('horarios');
    }
}
