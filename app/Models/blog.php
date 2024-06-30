<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = [
        'imagen',
        'comentario', // Nombre de la columna en la base de datos
        
    ];
    use HasFactory;

   
    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario'); // Ajusta 'id_usuario' según el nombre correcto de tu clave foránea
}

    }

