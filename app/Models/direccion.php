<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direccion';
    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'calle', 'numero', 'colonia', 'municipio', 'estado', 'usuario_id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id_usuario', 'id_usuario');
    }
}
