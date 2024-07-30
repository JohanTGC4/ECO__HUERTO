<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria_planta';
    protected $primaryKey = 'id_categoriaplanta'; // especifica la clave primaria
    // si es necesario, especifica las columnas fillable
    protected $fillable = ['nombre'];

    public function planta()
    {
        return $this->hasMany(Planta::class, 'id_categoriaplanta');
    }
}
