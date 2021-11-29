<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function iniciar(){
        $contador = 0;
        $usuarios = User::all();
        $products = Product::propuestos()->get();
        foreach($usuarios as $usuario){
            $contador += 1;
        }
        $i = 1;
        $categories = Category::all();
        return view('iniciar',compact('contador','products','i','categories'));
    }

    public function salir(){
        Auth::logout();
        return redirect('/');
    }
    public function validar(Request $request){
        $nombre = $request->input('correo');
        $usuario = User::where('correo',$nombre)->first();
        if(is_null($usuario)){
            return redirect('/login')->with('error','Usuario no registrado');
        }
        else{
            $password = $request->input('password');
            $password_bd = $usuario->password;
            if(Hash::check($password, $password_bd)){
                Auth::login($usuario);
                return redirect('/iniciar');
            }else{
                return redirect('/login')->with('error','Usuario o Password incorrecto.');
            }
        }
    }
}
