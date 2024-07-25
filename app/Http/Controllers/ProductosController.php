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
            'nombre' => 'required|alpha|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
        ],[
            'nombre.required' => 'El nombre debe tener datos válidos.',
            'nombre.alpha' => 'El nombre solo puede contener letras.',
            'precio.required' => 'Debes agregar un precio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'Debes agregar un stock.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'descripcion.required' => 'La descripción es obligatoria.',
        ]);
    
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images', 'public');
        } else {
            return back()->withErrors(['imagen' => 'Error al subir la imagen']);
        }
    
        Productos::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $imagePath,
            'descripcion' => $request->descripcion,
        ]);
    
        return redirect()->route('productCrud')->with('success', 'Producto agregado exitosamente');
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
            'nombre' => 'required|alpha|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2046',
            'descripcion' => 'required',
        ], [
            'nombre.required' => 'El nombre debe tener datos válidos.',
            'nombre.alpha' => 'El nombre solo puede contener letras.',
            'precio.required' => 'Debes agregar un precio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'Debes agregar un stock.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'descripcion.required' => 'La descripción es obligatoria.',
        ]); 
    
        if($request->hasFile('imagen')){
            $imagePath = $request->file('imagen')->store('images', 'public');
        } else {
            $imagePath = $producto->imagen; // Mantener la imagen actual si no se carga una nueva
        }
    
        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $imagePath,
            'descripcion' => $request->descripcion,
        ]);
    
        return redirect()->route('productCrud')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(String $id){
        $prod = productos::findOrFail($id);
        productos::where('id_producto', $id)->delete();
        $prod->delete();
        return redirect()->back();
    }
}