<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrador';
    // Configurar la clave primaria
    protected $primaryKey = 'id_administrado';

    protected $fillable = [
        'nombre', 'apellidop', 'apellidom','email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
   // Si la clave primaria no es incrementing (automáticamente generada), configúralo en false
   public $incrementing = true;

   // Configurar el tipo de la clave primaria si es necesario
   protected $keyType = 'int';
}
