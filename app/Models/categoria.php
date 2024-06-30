<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 'categoria_planta';
    use HasFactory;
   

    protected $primaryKey = 'id_categoriaplanta'; // especifica la clave primaria

    public $timestamps = false; // si no usas timestamps

    // si es necesario, especifica las columnas fillable
    protected $fillable = ['nombre'];
}
