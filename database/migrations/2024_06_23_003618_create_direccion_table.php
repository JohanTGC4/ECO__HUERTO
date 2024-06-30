<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionTable extends Migration
{
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->id('id_direccion');
            $table->string('calle', 200);
            $table->string('numero', 200);
            $table->string('colonia', 200);
            $table->string('municipio', 200);
            $table->string('estado', 200);
            $table->foreignId('usuario_id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
