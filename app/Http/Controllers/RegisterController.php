<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegisterController extends Controller
{
    public function verificarCorreo(Request $request)
    {
       
        if($request->ajax()){
            $mail = $request->get('mail');
            if($mail){
                $correoEncontrado = DB::table('users')->where('correo', 'like', $mail. '%')->get();
                    if($correoEncontrado){
                        return $correoEncontrado;    
                    }
            }
            
        }   
        return redirect('/login');
}   
}
