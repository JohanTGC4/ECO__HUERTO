<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\categoria;
use App\Models\planta;

class PlantaController extends Controller
{
    public function index(){
      
        $plants = planta::with('categoria')->latest()->get();
        $cats = categoria::all();
      
        return view('admin.Plantas.homeCrud', compact('plants'),compact('cats'));
    }

    public function create(){
        return view('admin.Plantas.plantaCreate');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|alpha|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
            'seleccion' => 'required|integer',
        ], [
            'nombre.required' => 'El nombre debe tener datos validos.',
            'imagen.required' => 'La imagen es obligatoria.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'seleccion.required' => 'Debes seleccionar una categoría.',
        ]);
    
        try {
            if($request->hasFile('imagen')){
                $imagePath = $request->file('imagen')->store('images', 'public');
            } else {
                return back()->withErrors(['imagen' => 'Error al subir la imagen']);
            }
    
            planta::create([
                'nombre' => $request->nombre,
                'imagen' => $imagePath,
                'descripcion' => $request->descripcion,
                'id_categoriaplanta' => $request->seleccion,
            ]);
    
            return redirect()->route('homeAdmin')->with('success', 'Planta agregada exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('homeAdmin')->with('error', 'Hubo un problema al agregar la planta');
        }
    }
    

    public function show($id){
        $plant = planta::findOrFail($id);
        return view('admin.Plantas.plantaShow', compact('plant'));
    }

    public function edit($id){
        $plant = planta::findOrFail($id);
        return response()->json($plant);
    }
   

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|regex:/^[\p{L} ]+$/u|max:255',
            'descripcion' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image'
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.'
        ]);
    
        $planta = Planta::findOrFail($id);
        $planta->nombre = $request->nombre;
        $planta->descripcion = $request->descripcion;
        $planta->categoria_id = $request->categoria_id;
    
        if ($request->hasFile('imagen')) {
            $planta->imagen = $request->file('imagen')->store('imagenes');
        }
    
        $planta->save();
    
        return redirect()->route('ruta.donde.redirigir')->with('success', 'Planta actualizada correctamente.');
    }

    
    public function destroy(String $id){
        $cat = planta::findOrFail($id);
        planta::where('id_categoriaplanta', $id)->delete();
        $cat->delete();
        return redirect()->back()->with('success', 'Planta eliminada exitosamente');
    }
}
