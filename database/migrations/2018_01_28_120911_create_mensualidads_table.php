<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensualidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensualidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->string('nombre');
            $table->string('representante')->nullable();
            $table->string('banco');
            $table->string('comprobante')->unique();
            $table->string('mes');
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
        Schema::dropIfExists('mensualidades');
    }
}
