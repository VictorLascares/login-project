<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compra;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user() != null){

            switch (Auth::user()->rol) {
                case 'Cliente':
                    # code...
                    $users = [];
                    break;

                case 'Encargado':
                    # PROPIOS
                    $users = User::sinsupervisor()->get();
                    break;

                case 'Supervisor':
                    # todos
                    $users = User::all();
                    break;
                case 'Contador':
                    # code...
                    $users = User::clientes()->get();
                    break;
            }
        }else{
            $users = [];
        }
        $i = 1;
        return view('usuarios.index',compact('users','i'));
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
        $costototal= 0;
        $gananciavendedor = 0;
        $gananciamercado = 0;
        $comprasVendedor= DB::table('compras')->select('ganancia','mercado','cantidad','product_id')->where('pago',false)->where('vendedor',$id)->whereNotIn('estado',['Comprado'])->get();
        foreach ($comprasVendedor as $comp) {
            $gananciavendedor += $comp->ganancia;
            $gananciamercado += $comp->mercado;
            $productoVendedor = Product::find($comp->product_id);
            $costototal += $productoVendedor->price*$comp->cantidad;
        }
        $user = User::find($id);
        $compras = Compra::all();
        $miscompras = [];
        $transacciones = 0;
        $productos = 0;
        $productsA = Product::aceptados()->get();
        $aceptados = 0;
        $comprados = 0;
        $oferta = 0;
        foreach ($compras as $compra) {
            $product = Product::find($compra->product_id);
            if($product->user_id == $id){
                if($compra->estado != 'Comprado' && $compra->pago == 'false'){
                    array_push($miscompras,$compra);
                }
                $transacciones++;
                $comprados += $compra->cantidad;
            }
        }

        $productosA = Product::productos($id)->get();
        foreach ($productosA as $producto) {
            $productos++;
        }
        $productosE = Product::productos($id)->existencia()->get();
        foreach ($productosE as $producto) {
            $oferta++;
        }
        $aceptadosA = Product::productos($id)->aceptados()->get();
        foreach ($aceptadosA as $aceptado) {
            $aceptados++;
        }
        $l = 1;
        return view('usuarios.show', compact('user','l','transacciones','productsA','productos','aceptados','comprados','oferta','miscompras','costototal','gananciavendedor','gananciamercado'));
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
