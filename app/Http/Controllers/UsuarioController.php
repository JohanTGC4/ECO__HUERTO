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
        

        $user = usuario::create([
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
        ]);
       
        return view('login');
    }




    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
      
        $credenciales = $request->only('email', 'password');
        // print_r($credenciales);
        // print_r(Auth::guard('usuario')->attempt($credenciales));
        // die();
        if (Auth::guard('usuario')->attempt($credenciales)) {
            Auth::shouldUse('usuario');
            $userId = Auth::id();
            $nombre = session('nombre');
        
            // print_r($nombre);
            // print_r($userId);
            // die();
            // Aquí puedes hacer lo que necesites con el ID y el nombre del usuario
           
            return to_route('perfilcli');
        
          
        }
        elseif (Auth::guard('admin')->attempt($credenciales)) {
            Auth::shouldUse('admin');
            $userId = Auth::id();
            $nombre = session('nombre');
        
         
            return to_route("homeAdmin");
          
            
        }else{
            throw ValidationException::withMessages([
                'email' => 'Correo o contraseña incorrectos'
            ]);
        }   
        // if (Auth::guard('clientes')->attempt(['correo' => $credenciales['correo'], 'password' => $credenciales['contrasena']])) {
        //     $usuario = usuario::where('correo', $credenciales['correo'])->first();
        //     Auth::guard('clientes')->login($usuario);// Inicia sesión con la guardia 'usuario'
        //     return redirect()->route('perfilcli');
        // }elseif (Auth::guard('admin')->attempt(['correo' => $credenciales['correo'], 'password' => $credenciales['contrasena']])) {
        //     $administrador = administrador::where('correo', $credenciales['correo'])->first();
        //     Auth::guard('admin')->login($administrador); // // Inicia sesión con la guardia 'admin'
        //     return redirect()->route('misplantas');
        // }
        


    //     if (Auth::guard('admin')->attempt(['correo' => $credenciales['correo'], 'password' => $credenciales['contrasena']])) {
    //         Auth::shouldUse('admin');

    //         // $userId = Auth::id();
    //         // $nombre = session('nombre');

    //         // print_r($userId);
    //         // die();
    //         return redirect()->route('misplantas');
    //     }elseif(Auth::guard('usuario')->attempt(['correo' => $credenciales['correo'], 'password' => $credenciales['contrasena']])) {
    //         Auth::shouldUse('usuario');
    //         // if (Auth::check()) {
    //         //     $userId = Auth::id();
    //         //     // Accede a la información del usuario autenticado
    //         //     print_r($userId);
    //         //     print_r("el usuario si esta autenticado");
    //         // } else {
    //         //     print_r("el usuario no esta autenticado");
    //         //     // El usuario no está autenticado, manejar el caso según tu lógica
    //         // }
    //         // die();
    //         return to_route('perfilcli');
    //     }else{

    

      
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('login');
    }
}