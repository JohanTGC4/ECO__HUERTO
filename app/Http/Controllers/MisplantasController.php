<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Planta;
use App\Models\MisPlantas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class MisplantasController extends Controller
{
   /* public function index(Request $request)
    {
        $categorias = Categoria::all();
        $plantas = collect(); // Colección vacía por defecto

        if ($request->has('categoria')) {
            $plantas = Planta::where('categoria_id', $request->categoria)->get();
        }

        return view('Cliente.misplantas', compact('categorias', 'plantas'));
    }*/
   

    public function index(Request $request)
    {
        // Obtener todas las categorías para mostrar en el formulario
        $categorias = Categoria::all();
        $userId = Auth::id();

           // Obtener las plantas del usuario autenticado
    $misplantas = MisPlantas::where('usuario_id_usuario', $userId)
    ->with('planta') // Cargar la relación planta
    ->get();

        // Verificar si se está haciendo una solicitud AJAX
        if ($request->ajax()) {
            // Si la solicitud tiene el parámetro 'categoria'
            if ($request->has('categoria')) {
                $categoria_id = $request->input('categoria');
    
                // Obtener las plantas de la categoría seleccionada
                $plantas = Planta::where('id_categoriaplanta', $categoria_id)->get();
    
                // Devolver las plantas como respuesta JSON
                return response()->json($plantas);
            } else {
                // Si no se proporcionó 'categoria', retornar una respuesta de error 400
                return response()->json([], 400);
            }
        }
    
        // Si no es una solicitud AJAX, renderizar la vista con las categorías
        return view('misplantas', compact('categorias','misplantas'));
    }
       // Método para almacenar una nueva planta del usuario
       public function store(Request $request)
       {
        $userId = 1;
           // Obtener la planta seleccionada por su ID
           $planta = Planta::findOrFail($request->planta);
       
       
           // Guardar la relación en misplantas
           MisPlantas::create([
               'planta_id_planta' => $planta->id_planta,
               'usuario_id_usuario' => $userId,
           ]);
       
           // Redireccionar o devolver una respuesta según tu lógica
           
           return redirect()->route('misPlantas.index')->with('success', 'Planta agregada correctamente');
       }
       
}