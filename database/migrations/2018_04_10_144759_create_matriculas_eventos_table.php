<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evento')->unsigned();
            $table->integer('matricula')->unsigned();
            $table->foreign('evento')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('matricula')->references('id')->on('matriculas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('matriculas_eventos');
    }
}
