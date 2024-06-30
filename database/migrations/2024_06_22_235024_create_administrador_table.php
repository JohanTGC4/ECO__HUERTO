<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorTable extends Migration
{
    public function up()
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id('id_administrado');
            $table->string('nombre', 200);
            $table->string('apellidop', 200);
            $table->string('apellidom', 200);
            $table->string('correo', 200);
            $table->string('contrasena', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrador');
    }
}
