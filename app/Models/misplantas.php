<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class misplantas extends Model
{
    use HasFactory;
    protected $table = 'misplantas';
    protected $primaryKey = 'id_misplantas'; // Asegúrate de especificar la clave primaria si es diferente a 'id'
    protected $fillable = [
        'usuario_id_usuario',
        'planta_id_planta',
    ];
   /* public function planta(){
        return $this->belongsTo(Planta::class, 'id_planta');
    }*/
    public function planta()
    {
        return $this->belongsTo(Planta::class, 'planta_id_planta', 'id_planta');
    }
  
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id_usuario', 'id_usuario');
    }
}
