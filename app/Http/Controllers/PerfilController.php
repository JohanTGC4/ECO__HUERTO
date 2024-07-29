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
          // Verifica si hay una dirección seleccionada
    if (!$direccionSeleccionada) {
        // No hay dirección seleccionada, establece una dirección predeterminada
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
        $usuario = Auth::user();
        
        // Crear una nueva instancia de Direccion
        $direccion = new Direccion();
        $direccion->usuario_id_usuario = $usuario->id_usuario;
        $direccion->calle = $request->input('calle');
        $direccion->numero = $request->input('numero');
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
            'direccion_select' => 'required', // Asegúrate de que el campo direccion_select sea requerido
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
    
        return redirect()->route('perfilcli')->with('success', 'Perfil actualizado correctamente.');
    }
    
    
    public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        return redirect()->back()->with('success', 'Dirección eliminada correctamente.');
    }
}
