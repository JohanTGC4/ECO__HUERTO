<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Planta;
use App\Models\MisPlantas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisplantasController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $userId = Auth::id();
        $misplantas = MisPlantas::where('usuario_id_usuario', $userId)->with('planta')->get();

           // Obtener las plantas del usuario autenticado
    $misplantas = MisPlantas::where('usuario_id_usuario', $userId)
    
    ->with('planta') // Cargar la relación planta
    ->get();

        // Verificar si se está haciendo una solicitud AJAX
        if ($request->ajax()) {
            if ($request->has('categoria')) {
                $categoriaId = $request->input('categoria');
                $plantas = Planta::where('id_categoriaplanta', $categoriaId)->get(['id_planta', 'nombre', 'imagen']);
                return response()->json($plantas);
            }
        }
      
        // Si no es una solicitud AJAX, renderizar la vista con las categorías
        return view('misplantas', compact('categorias','misplantas'));
    }
       // Método para almacenar una nueva planta del usuario
       public function store(Request $request)
       {
        $userId = Auth::id();
           // Obtener la planta seleccionada por su ID
           $planta = Planta::findOrFail($request->planta);
       
       
           // Guardar la relación en misplantas
           MisPlantas::create([
               'planta_id_planta' => $planta->id_planta,
               'usuario_id_usuario' => $userId,
           ]);
           
         // Obtener las plantas del usuario actualizadas
    $misplantas = MisPlantas::where('usuario_id_usuario', $userId)
    ->with('planta') // Cargar la relación planta
    ->get();
           // Redireccionar o devolver una respuesta según tu lógica
           
           return redirect()->route('misPlantas.index')->with('success', 'Planta agregada correctamente');
       }
       
}
