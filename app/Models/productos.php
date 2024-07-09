<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    
 
    use HasFactory;
    
    protected $table = 'productos';
    protected $primaryKey = 'id_producto'; // Asegúrate de usar el nombre correcto de la clave primaria
   

    

    protected $fillable = ['nombre','precio','stock', 'descripcion','imagen']; // Asegúrate de incluir todos los campos necesarios

    
}
