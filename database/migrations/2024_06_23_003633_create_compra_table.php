<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id('id_compra');
            $table->string('folio', 50);
            $table->decimal('sub_total', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreignId('carrito_id_carrito')->constrained('carrito')->references('id_carrito')->on('carrito');
            $table->foreignId('direccion_id_direccion')->constrained('direccion')->references('id_direccion')->on('direccion');
            $table->string('estatus', 20);
            $table->unique('carrito_id_carrito');
            $table->unique('direccion_id_direccion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
