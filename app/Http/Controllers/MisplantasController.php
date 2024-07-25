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

        if ($request->ajax()) {
            if ($request->has('categoria')) {
                $categoriaId = $request->input('categoria');
                $plantas = Planta::where('id_categoriaplanta', $categoriaId)->get(['id_planta', 'nombre', 'imagen']);
                return response()->json($plantas);
            }
        }

        return view('misplantas', compact('categorias', 'misplantas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id_usuario' => 'required|integer',
            'planta' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);

        $misplanta = new MisPlantas();
        $misplanta->usuario_id_usuario = $request->usuario_id_usuario;
        $misplanta->planta_id_planta = $request->planta;
      

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Mueve la imagen al directorio public/images
            $misplanta->imagen = $imageName; // Guarda el nombre de la imagen en la base de datos
        }
        $misplanta->save();
        // Obtén todas las plantas asociadas al usuario
        $misplantas = MisPlantas::where('usuario_id_usuario', $request->usuario_id_usuario)
                                ->with('planta')
                                ->get();

        return response()->json(['misplantas' => $misplantas]);
    }
}
