<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantaTable extends Migration
{
    public function up()
    {
        Schema::create('planta', function (Blueprint $table) {
            $table->id('id_planta');
            $table->string('nombre', 200);
            $table->string('imagen', 200);
            $table->string('descripcion', 200);
            $table->foreignId('id_categoriaplanta')->constrained('categoria_planta')->references('id_categoriaplanta')->on('categoria_planta');
            // $table->foreignId('misplantas_id_misplantas')->constrained('misplantas')->references('id_misplantas')->on('misplantas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('planta');
    }
}
