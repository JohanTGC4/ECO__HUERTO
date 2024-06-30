<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaPlantaTable extends Migration
{
    public function up()
    {
        Schema::create('categoria_planta', function (Blueprint $table) {
            $table->id('id_categoriaplanta');
            $table->string('nombre', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria_planta');
    }
}
