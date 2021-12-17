<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompraController extends Controller
{
    //
    public function compras(){
        $compras = Compra::comprado()->get();
        $productos = Product::all();
        $usuarios = User::all();
        return view('contador.compras',compact('compras','productos', 'usuarios'));
    }

    public function comprar(Request $request, $metodo,$id) {
        $compra = new Compra();
        $producto = Product::find($id);
        if($metodo == 'banco'){
            $ticket = $request->file('ticket');
            $compra->cantidad = $request->input('cantidad');
            if(!is_null($ticket)){
                $ruta_destino = public_path('fotos/tickets/');
                $nombre_de_archivo = time().'.'.$ticket->getClientOriginalExtension();
                $ticket->move($ruta_destino,$nombre_de_archivo);
                $compra['ticket']= $nombre_de_archivo;
            }
            $compra->estado = 'Comprado';
            $producto->existencia = $producto->existencia - $request->input('cantidad');
        }else if($metodo == 'linea'){
            $compra->cantidad = $request->input('cantidadLinea');
            $producto->existencia = $producto->existencia - $request->input('cantidadLinea');
        }
        $compra->ganancia = $producto->price*$compra->cantidad*(100-$producto->porcentaje)/100;
        $compra->mercado = $producto->price*$compra->cantidad*($producto->porcentaje)/100;
        $compra->vendedor = $producto->user_id;

        $compra->product_id = $id;
        $compra->user_id = Auth::user()->id;

        $producto->save();
        $compra->save();

        return redirect()->route('products.index');
    }

    public function updateEstado($id){
        $compra = Compra::find($id);
        if ($compra->estado == 'Validado') {
            $compra->estado = 'Entregado';
            $compra->save();
            return redirect()->route('products.index');
        } else {
            $compra->estado = 'Validado';
            $compra->save();
            return redirect('compras');
        }
    }

    public function updatePago($id){
        $compra = Compra::find($id);
        $compra->pago = true;
        $compra->save();

        return redirect('/iniciar');
    }

    public function updatePagos($id){
        $compras = Compra::where('pago',false)->where('vendedor',$id)->whereNotIn('estado',['Comprado'])->get();
        foreach ($compras as $compra) {
            $compra->pago = true;
            $compra->save();
        }
        return redirect('users');
    }


    public function updateCalificado(Request $request, $id){
        $compra = Compra::find($id);
        $compra->calificacion = $request->input('estrellas');
        $compra->save();

        return redirect()->route('products.index');
    }
}
