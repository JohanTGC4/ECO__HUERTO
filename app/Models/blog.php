<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;

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
    return $this->belongsTo(usuario::class, 'usuario_id_usuario', 'id_usuario');
    
}

    }

