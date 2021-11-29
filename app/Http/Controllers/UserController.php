<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $user = User::all();
        $i = 1;
        return view('usuarios.index',compact('users','user','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.sigup');
    }//Usuario create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->all();

        if($user['password']!=$user['password2'])
            return redirect()->back()->with('error',"El password no esta bien confirmado");
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move($ruta_destino,$nombre_de_archivo);
            $user['imagen']= $nombre_de_archivo;
        }
        $user['password']=Hash::make($user['password']);
        $registro = new User();
        $registro->fill($user);
        $registro->save();

        if(Auth::user() != null){
            return redirect('/iniciar');
        }else{
            return redirect('/login');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->first();
        $users = User::find($id);
        return view('usuarios.editUser',compact('user','users'));
    }
    public function editpass($id)
    {
        $user = User::find($id);
        return view('usuarios.resetPassword', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->only(['password','password2'])){
            if($request['password']!=$request['password2'])
            return redirect()->back()->with('error',"El password no esta bien confirmado");
            $user = User::find($id);
            $user['password']=Hash::make($request->input('password'));
             $user->save();
            return redirect('users');
        }

        $user = User::find($id);
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move($ruta_destino,$nombre_de_archivo);
            $user['imagen']= $nombre_de_archivo;
        }
        $user->nombre = $request->nombre;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->correo = $request->correo;
        $user->save();

        return redirect('users');

    }

    public function updateEstado(Request $request, $id, $estado)
    {
        $user=User::find($id);
        $user->estado = $estado;
        $user->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $path = $user->imagen;
        unlink(public_path('fotos/'.$path));
        User::destroy($id);
        return redirect('users');
    }


}
