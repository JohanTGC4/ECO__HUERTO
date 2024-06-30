<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MisPlantas;
class planta extends Model
{
    
 
    use HasFactory;
    
    protected $table = 'planta';
    protected $primaryKey = 'id_planta'; // Asegúrate de usar el nombre correcto de la clave primaria
    public $timestamps = false; // Si no usas timestamps

    // Define relaciones si las hay
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoriaplanta');
    }
    public function misplantas()
    {
        return $this->hasMany(MisPlantas::class, 'id_planta', 'id_planta');
    }

    protected $fillable = ['nombre','imagen','descripcion', 'id_categoriaplanta']; // Asegúrate de incluir todos los campos necesarios
}
