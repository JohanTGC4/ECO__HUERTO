<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Planta;
use App\Models\MisPlantas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\usuario;
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
    public function getPlantaDetails(Request $request)
{
    $planta = Planta::find($request->planta_id);

    if ($planta) {
        return response()->json([
            'nombre' => $planta->nombre,
            'imagen' => Storage::url($planta->imagen), // Asegúrate de que el campo imagen esté en el modelo
        ]);
    }

    return response()->json([], 404);
}

       // Método para almacenar una nueva planta del usuario
       public function store(Request $request)
       {
       
           // Obtener el usuario autenticado
    $usuario = Auth::user(); // Obtiene el objeto del usuario autenticado

    // Obtener la planta seleccionada por su ID
    $planta = Planta::findOrFail($request->planta);

    // Guardar la relación en misplantas
    MisPlantas::create([
        'planta_id_planta' => $planta->id_planta,
        'usuario_id_usuario' => $usuario->id_usuario, // Utiliza el ID del usuario autenticado
    ]);

    // Redireccionar o devolver una respuesta según tu lógica
    return redirect()->route('misplantas.index')->with('success', 'Planta se agregada correctamente');
       }

       public function show($id)
       {
           $planta = Planta::find($id);
   
           if ($planta) {
               return response()->json([
                   'nombre' => $planta->nombre,
                   'descripcion' => $planta->descripcion,
                   'imagen' => $planta->imagen ? Storage::url($planta->imagen) : null, // Asegúrate de que esta línea devuelva la URL correcta de la imagen
               ]);
           } else {
               return response()->json(['error' => 'Planta no encontrada.'], 404);
           }
       }

       public function destroy($id_misplantas)
       {
           // Encuentra la planta por ID
           $misPlanta = MisPlantas::find($id_misplantas);
       
           // Verifica si la planta existe
           if ($misPlanta) {
               // Elimina la planta
               $misPlanta->delete();
       
               // Redirige con mensaje de éxito
               return redirect()->route('misplantas.index')->with('success', 'Planta eliminada correctamente');
           }
       
           // Redirige con mensaje de error si la planta no fue encontrada
           return redirect()->route('misplantas.index')->with('error', 'Planta no encontrada');
       }
       /*public function showDetails($id)
       {
           $planta = Planta::findOrFail($id);
           return view('detalles', compact('planta'));
       }*/
       public function showDetails($id_planta)
       {
           $planta = Planta::findOrFail($id_planta);
           return response()->json([
               'imagen' => Storage::url($planta->imagen),
               'nombre' => $planta->nombre,
               'descripcion' => $planta->descripcion
           ]);
       }
       
       
       
       

}

