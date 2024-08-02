<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Direccion;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $direcciones = Direccion::where('usuario_id_usuario', $usuario->id_usuario)->get();
        $direccionSeleccionada = $usuario->direccionSeleccionada;
          // Verifica dirección seleccionada
    if (!$direccionSeleccionada) {
        // dirección predeterminada
        $direccionPredeterminada = new Direccion();
        $direccionPredeterminada->calle = 'Calle Predeterminada';
        $direccionPredeterminada->numero = 'Número Predeterminado';
        $direccionPredeterminada->colonia = 'Colonia Predeterminada';
        $direccionPredeterminada->municipio = 'Municipio Predeterminado';
        $direccionPredeterminada->estado = 'Estado Predeterminado';

        // Asigna la dirección predeterminada a $direccionSeleccionada
        $direccionSeleccionada = $direccionPredeterminada;
    }

        
        return view('perfilcli', compact('usuario', 'direcciones', 'direccionSeleccionada'));
    }
  

    public function store(Request $request)
{
    $request->validate([
        'calle' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\-\.]+$/u'  // letras, espacios, guiones y puntos
        ],
        'numero' => [
            'required',
            'string',
            'regex:/^[\d\s\-]+$/u' // números, espacios y guiones
        ],
        'numero_e' => [
            'required',
            'string',
            'regex:/^[\d\s\-]+$/u' // números, espacios y guiones
        ],
        'colonia' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\-\.]+$/u'  // letras, espacios, guiones y puntos
        ],
        'municipio' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\-\.]+$/u'  // letras, espacios, guiones y puntos
        ],
        'estado' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\-\.]+$/u'  // letras, espacios, guiones y puntos
        ],
    ], [
        'calle.required' => 'La calle es obligatoria.',
        'numero.required' => 'El número es obligatorio.',
        'numero_e.required' => 'El número es obligatorio.',
        'colonia.required' => 'La colonia es obligatoria.',
        'municipio.required' => 'El municipio es obligatorio.',
        'estado.required' => 'El estado es obligatorio.',
        'calle.regex' => 'La calle solo puede contener letras, espacios, guiones y puntos.',
        'numero.regex' => 'Agrega un numero valido',
        'numero_e.regex' => 'Agrega un numero valido',
        'colonia.regex' => 'La colonia solo puede contener letras, espacios, guiones y puntos.',
        'municipio.regex' => 'El municipio solo puede contener letras, espacios, guiones y puntos.',
        'estado.regex' => 'El estado solo puede contener letras, espacios, guiones y puntos.',
    ]);

    $usuario = Auth::user();

    // Crear una nueva instancia de Direccion
    $direccion = new Direccion();
    $direccion->usuario_id_usuario = $usuario->id_usuario;
    $direccion->calle = $request->input('calle');
    $direccion->numero = $request->input('numero');
    $direccion->numero = $request->input('numero_e');
    $direccion->colonia = $request->input('colonia');
    $direccion->municipio = $request->input('municipio');
    $direccion->estado = $request->input('estado');

    // Guardar la dirección
    $direccion->save();

    return redirect()->back()->with('success', 'Dirección agregada correctamente.');
}

    public function update(Request $request)
    {
        // Validación de formulario
        $request->validate([
            'usuario' => 'required',
            'email' => 'required|email',
            'direccion_select' => 'required',
        ],[
            'usuario.required' => 'El nombre debe tener datos validos.',
            'email.required' => 'Debes agregar un correo valido.',
            
            'direccion_select' => 'Debes seleccionar una direccion.',
        ]);
    
        // Obtener el usuario autenticado
        $usuario = Auth::user();
    
        // Actualizar los campos del usuario
        $usuario->usuario = $request->input('usuario');
        $usuario->email = $request->input('email');
    
        // Guardar la imagen de perfil si se proporciona una nueva
        if ($request->hasFile('fotoperfil')) {
            // Eliminar la imagen anterior si existe
            if ($usuario->fotoperfil) {
                Storage::disk('public')->delete($usuario->fotoperfil);
            }
    
            // Almacenar la nueva imagen
            $imagePath = $request->file('fotoperfil')->store('assets/images', 'public');
            $usuario->fotoperfil = $imagePath;
        }
    
        // Obtener el ID de la dirección seleccionada desde el formulario
        $direccionSeleccionadaId = $request->input('direccion_select');
    
        // Almacenar el ID de la dirección seleccionada en la sesión
        session(['direccion_id_seleccionada' => $direccionSeleccionadaId]);
    
        // Guardar los cambios en el usuario
        $usuario->save();
    
        return response()->json(['success' => 'Perfil actualizado correctamente.']);
    }
    
    
   /* public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        return redirect()->back()->with('success', 'Dirección eliminada correctamente.');
    }*/

    public function destroy($id)
{
    $direccion = Direccion::findOrFail($id);
    $direccion->delete();

    return redirect()->back()->with('success', 'Dirección eliminada correctamente.');
}
}
