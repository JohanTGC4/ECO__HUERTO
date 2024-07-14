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

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
        ]);

        categoria::create([
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
        $cat = categoria::find($id);
        $request->validate([
            'nombre' => 'required',
         
        ]); 

       
        $cat->nombre = $request->nombre;
      

        $cat->save();

        return redirect()->route('categoryCrud')->with('success', 'Categoría actualizada exitosamente');
    }
   

    public function destroy(String $id){
        $cat = categoria::find($id);
        planta::where('id_categoriaplanta', $id)->delete();
        $cat->delete();
        return redirect()->back();
    }
}