<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id('id_blog');
            $table->string('comentario', 200);
            $table->string('imagen', 10)->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('usuario_id_usuario');
            $table->foreign('usuario_id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
