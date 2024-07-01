<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class usuario extends Authenticatable
{
    

    use Notifiable;
   

    protected $table = 'usuario';

    // Configurar la clave primaria
    protected $primaryKey = 'id_usuario';

    // Otros atributos del modelo
    protected $fillable = [
        'usuario', 'email', 'password',
    ];

    // Si la clave primaria no es incrementing (automáticamente generada), configúralo en false
    public $incrementing = true;

    // Configurar el tipo de la clave primaria si es necesario
    protected $keyType = 'int';
}
