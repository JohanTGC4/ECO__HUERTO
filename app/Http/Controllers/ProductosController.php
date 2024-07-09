<?php
namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\productos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductosController extends Controller{
    public function index(){
        $prod = productos::all();
       
        return view('admin.Productos.productosCrud', compact('prod'));
    }

    public function create(){
        return view('admin.Categorias.categoryCreate');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
        ]);

        if($request->hasFile('imagen')){
            $imagePath = $request->file('imagen')->store('images', 'public');
        }else{
            
            return back()->withErrors(['imagen' => 'Error al subir la imagen']);
        }

        productos::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $imagePath,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productCrud')->with('success', '´Producto agregada exitosamente');
    }

    public function show($id){
        $prod = productos::findOrFail($id);
        return view('admin.Productos.productoShow', compact('prod'));
    }

    public function edit($id){
        $prod = productos::findOrFail($id);
     
        return response()->json($prod);
    
    }

    public function update(Request $request, $id){
        $producto = productos::find($id);
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
        ]); 

        if($request->hasFile('imagen')){
            $imagePath = $request->file('imagen')->store('images', 'public');
        }else{
            
            return back()->withErrors(['imagen' => 'Error al subir la imagen']);
        }
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->imagen = $imagePath;
        $producto->descripcion = $request->descripcion;

        $producto->save();

        return redirect()->route('productCrud')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy(String $id){
        $prod = productos::find($id);
        $prod->delete();
        return redirect()->back();
    }
}