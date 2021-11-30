<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompraController extends Controller
{
    //

    public function comprar(Request $request, $metodo,$id) {
        $compra = new Compra();
        $compra->cantidad = $request->input('cantidad');
        if($metodo == 'banco'){
            $ticket = $request->file('ticket');
            if(!is_null($ticket)){
                $ruta_destino = public_path('fotos/tickets/');
                $nombre_de_archivo = time().'.'.$ticket->getClientOriginalExtension();
                $ticket->move($ruta_destino,$nombre_de_archivo);
                $compra['ticket']= $nombre_de_archivo;
            }
            $compra->estado = 'Comprado';
        }
        $compra->product_id = $id;
        $compra->user_id = Auth::user()->id;
        $compra->save();

        return redirect()->route('products.index');
    }
}
