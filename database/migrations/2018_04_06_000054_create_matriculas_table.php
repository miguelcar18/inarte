<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cedula')->nullable();
            $table->string('nombre');
            $table->integer('cedulaRepresentante')->nullable();
            $table->string('representante')->nullable();
            $table->date('fechaNacimiento');
            $table->integer('disciplina')->unsigned();
            $table->foreign('disciplina')->references('id')->on('disciplinas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('matriculas');
    }
}
