<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UsuarioController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validación
            $request->validate([
                'usuario' => 'required|string|max:255',
                'email' => 'required|email|unique:usuario,email',
                'password' => [
                    'required',
                    'min:8',
                    'regex:/[a-zA-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&]/',
                ],
            ], [
                'email.unique' => 'Este correo ya esta siendo utilizado por otro usuario.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
            ]);

            Usuario::create([
                'usuario' => $request->usuario,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente. Puedes iniciar sesión.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ]);
        }
    }
    


    public function login(Request $request)
{
    $credenciales = $request->validate([
        'email' => ['required'],
        'password' => ['required']
    ]);

    $credenciales = $request->only('email', 'password');

    if (Auth::guard('usuario')->attempt($credenciales)) {
        Auth::shouldUse('usuario');
        $userId = Auth::id();
        $nombre = session('nombre');

        return response()->json([
            'success' => true,
            'redirect' => route('perfilcli')
        ]);
    }
    elseif (Auth::guard('admin')->attempt($credenciales)) {
        Auth::shouldUse('admin');
        $userId = Auth::id();
        $nombre = session('nombre');

        return response()->json([
            'success' => true,
            'redirect' => route('homeAdmin')
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Correo o contraseña incorrectos.'
        ]);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('login');
    }
}