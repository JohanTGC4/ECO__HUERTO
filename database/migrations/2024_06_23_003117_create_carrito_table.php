<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id_carrito');
            $table->unsignedBigInteger('productos_id_producto');
            $table->unsignedBigInteger('usuario_id_usuario');
            $table->foreign('productos_id_producto')->references('id_producto')->on('productos');
            $table->foreign('usuario_id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
