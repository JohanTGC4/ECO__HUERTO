<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Accede a los datos del usuario
        $name = $user->usuario;
        $email = $user->email;
        return view('perfilcli',['user' => $user]);
    
        

        
    }
   
}
