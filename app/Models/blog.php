<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;

class blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $primaryKey = 'id_blog'; // Suponiendo que la clave primaria se llama 'id'
    protected $fillable = [
        'imagen',
        'comentario', // Nombre de la columna en la base de datos
        'usuario_id_usuario', // Añadido para permitir la asignación masiva
        'fecha',
        'hora',
    ];
    public function usuario()
{
    return $this->belongsTo(usuario::class, 'usuario_id_usuario', 'id_usuario');
    
}

    }

