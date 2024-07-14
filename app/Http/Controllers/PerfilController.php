<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Usuario; // Corregido: debería ser 'Usuario'
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $direcciones = Direccion::where('usuario_id_usuario', $usuario->id_usuario)->get();
        // Obtén la primera dirección como la dirección seleccionada inicialmente
        $direccionSeleccionada = $direcciones->first();
        
        return view('perfilcli', ['usuario' => $usuario, 'direcciones' => $direcciones, 'direccionSeleccionada'=>$direccionSeleccionada]);
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
            'direccion_select' => 'required', // Asegúrate de que el campo dirección_select sea requerido
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
           // Actualizar la dirección seleccionada del usuario
           $usuario->direccion_id_seleccionada = $request->input('direccion_select');
    
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
