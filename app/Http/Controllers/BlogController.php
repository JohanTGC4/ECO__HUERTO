<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class BlogController extends Controller
{

    // Método para mostrar todas las publicaciones del blog
    public function index()
    {
        // Obtener todas las publicaciones con información del usuario y ordenar por fecha de creación
        $blogs = Blog::with('usuario')->orderBy('created_at', 'desc')->get();
        // Retornar la vista 'blog' con las publicaciones
        return view('blog', compact('blogs'));
    }

    // Método para almacenar una nueva publicación
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'comentario' => 'required|string|max:255', // El comentario es obligatorio y debe ser una cadena de texto
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // La imagen es opcional, debe ser una imagen con tipos MIME específicos y tamaño máximo de 2MB
            
        ]);

        // Inicializar la variable $path como null
        $path = null;
        // Si se ha subido un archivo de imagen, almacenar la imagen en el directorio 'assets/images' dentro de 'public'
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('assets/images', 'public');
        }
        $fecha = now()->toDateString();
        $hora = now()->toTimeString();
        // Crear una nueva publicación en la base de datos con los datos del formulario
        Blog::create([
            'comentario' => $request->comentario, // Asignar el comentario
            'imagen' => $path ? '/storage/' . $path : null, // Asignar la URL de la imagen si se subió, de lo contrario, null
            'usuario_id_usuario' => Auth::user()->id_usuario ,// Asignar el ID del usuario autenticado
            'fecha' => $fecha,
            'hora' => $hora,
        ]);

        // Redirigir a la ruta 'blog.index' con un mensaje de éxito
        return redirect()->route('blog.index')->with('success', 'Publicación creada exitosamente');
    }

    // Método para mostrar el formulario de edición de una publicación
    public function edit($id)
    {
        // Buscar la publicación por ID
        $blog = Blog::findOrFail($id);
        // Retornar la vista 'editb' con la publicación
        return view('editb', compact('blog'));
    }

    // Método para actualizar una publicación existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'comentario' => 'required|string|max:255', // El comentario es obligatorio y debe ser una cadena de texto
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // La imagen es opcional, debe ser una imagen con tipos MIME específicos y tamaño máximo de 2MB
        ]);

        // Buscar la publicación por ID
        $blog = Blog::findOrFail($id);
        
        // Si se ha subido un archivo de imagen, actualizar la imagen
        if ($request->hasFile('imagen')) {
            // Si la publicación tiene una imagen existente, eliminarla del almacenamiento
            if ($blog->imagen) {
                Storage::delete('public/' . str_replace('/storage/', '', $blog->imagen));
            }
            // Almacenar la nueva imagen en el directorio 'assets/images' dentro de 'public'
            $path = $request->file('imagen')->store('assets/images', 'public');
            // Asignar la URL de la nueva imagen a la publicación
            $blog->imagen = '/storage/' . $path;
        }

        // Actualizar el comentario de la publicación
        $blog->comentario = $request->comentario;
        // Guardar los cambios en la base de datos
        $blog->save();

        // Redirigir a la ruta 'blog.index' con un mensaje de éxito
        return redirect()->route('blog.index')->with('success', 'Publicación actualizada exitosamente');
    }

    // Método para eliminar una publicación
    public function destroy($id)
    {
        // Buscar la publicación por ID
        $blog = Blog::findOrFail($id);
        // Si la publicación tiene una imagen, eliminarla del almacenamiento
        if ($blog->imagen) {
            Storage::delete('public/' . str_replace('/storage/', '', $blog->imagen));
        }
        // Eliminar la publicación de la base de datos
        $blog->delete();
        // Redirigir a la ruta 'blog.index' con un mensaje de éxito
        return redirect()->route('blog.index')->with('success', 'Publicación eliminada exitosamente');
    }
}
