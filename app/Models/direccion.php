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
    public function direccionSeleccionada()
    {
        // Implementa la lógica para obtener la dirección seleccionada
        // Puedes definir tus propios criterios para determinar cuál es la dirección seleccionada
        return $this->direcciones()->first(); // Ejemplo básico: obtiene la primera dirección
    }
}
