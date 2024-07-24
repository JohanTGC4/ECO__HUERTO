<?php
namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\planta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoriaController extends Controller{
    public function index(){
        $cats = categoria::all();
      
        return view('admin.Categorias.categoryCrud', compact('cats'));
    }

    public function create(){
        return view('admin.Categorias.categoryCreate');
    }

   public function store(Request $request) {
    $request->validate([
        'nombre' => 'required|alpha|max:255',
    ],[
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.alpha' => 'El nombre solo puede contener letras.',
    ]);

    Categoria::create([
        'nombre' => $request->nombre,
    ]);

    return redirect()->route('categoryCrud')->with('success', 'Categoría agregada exitosamente');
}
    public function show($id){
        $cat = categoria::findOrFail($id);
        return view('admin.Categorias.categoryShow', compact('cat'));
    }

    public function edit($id){
        $cat = categoria::findOrFail($id);
        return response()->json($cat);
    }
    public function update(Request $request, $id){
    $cat = Categoria::find($id);

    if (!$cat) {
        return redirect()->route('categoryCrud')->with('error', 'Categoría no encontrada');
    }

    $request->validate([
        'nombre' => 'required|alpha',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.alpha' => 'El nombre solo debe contener letras.',
    ]);

    $cat->nombre = $request->nombre;
    $cat->save();

    return redirect()->route('categoryCrud')->with('success', 'Categoría actualizada exitosamente');

    }
    public function destroy(String $id) {
        // Verificar si la categoría está en uso
        $isUsed = Planta::where('id_categoriaplanta', $id)->exists();
        if ($isUsed) {
            return redirect()->route('categoryCrud')->with('error', 'No se puede eliminar la categoría porque está siendo utilizada en un registro.');
        }
    
        $cat = Categoria::find($id);
        $cat->delete();
    
        return redirect()->route('categoryCrud')->with('success', 'Categoría eliminada exitosamente');
    }

    
}