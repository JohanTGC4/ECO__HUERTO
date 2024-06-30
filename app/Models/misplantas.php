<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisPlantas extends Model
{
    protected $table = 'misplantas';
    protected $primaryKey = 'id_misplantas'; // Asegúrate de especificar la clave primaria si es diferente a 'id'
    use HasFactory;
    protected $fillable = [
        'planta_id_planta', // Por defecto, Eloquent maneja el id de la planta
        'usuario_id_usuario', // Añade aquí los campos que deseas permitir asignación masiva
        
    ];
   /* public function planta(){
        return $this->belongsTo(Planta::class, 'id_planta');
    }*/
    public function planta()
    {
        return $this->belongsTo(Planta::class, 'id_planta', 'id_planta');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
