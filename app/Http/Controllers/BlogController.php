<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::with('usuario')->latest()->get();
      
        return view('blog', compact('posts'));
    }

    // Controlador para mostrar un blog específico
// Controlador para mostrar un blog específico
public function show($id)
{
    
    $posts = Blog::with('usuario')->latest()->get(); // Cargar la relación 'usuario'
    return view('blog', compact('posts'));
}


    public function store(Request $request)
    {
       
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/images', 'public');
        }
        $id_usuario = 1; 
        $post = new Blog();
        $post->comentario = $request->comentario;
        $post->imagen = $imagePath;
        $post->fecha = now(); 
        $post->hora = now()->format('H:i:s'); // Asignar la hora actual o el valor que necesites
        $post->usuario_id_usuario = $id_usuario; // Asignar el ID del usuario existente
       
       
        $post->save();
    
        return redirect()->route('blog.index'); // Redirige a la vista de listado de blogs después de guardar
    }
    

    public function destroy($id)
    {
        $post = Blog::findOrFail($id);
       
        $post->delete();

        return redirect()->route('blog.index');
    }
    public function edit($id)
    {
        $post = Blog::findOrFail($id);
      
        return view('blog.edit', compact('post'));
       
    
    }

    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);
        // Actualizar el comentario
        $post->comentario = $request->input('comentario');

        // Actualizar la imagen si se proporciona una nueva
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imageName = time() . '.' . $imagen->getClientOriginalExtension();
            // Guardar la nueva imagen
            $post->imagen = $request->file('imagen')->store('assets/images', 'public');
            $post->imagen = $imageName;
        }

        $post->save();

      
    }

}

