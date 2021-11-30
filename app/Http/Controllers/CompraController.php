<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompraController extends Controller
{
    //

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
        $compra->product_id = $id;
        $compra->user_id = Auth::user()->id;

        $producto->save();
        $compra->save();

        return redirect()->route('products.index');
    }

    public function updateEstado($id){
        $compra = Compra::find($id);
        $compra->estado = 'Entregado';
        $compra->save();

        return redirect()->route('products.index');
    }

    public function updateCalificado(Request $request, $id){
        $compra = Compra::find($id);
        $compra->calificacion = $request->input('estrellas');
        $compra->save();

        return redirect()->route('products.index');
    }
}
