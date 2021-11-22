<?php

namespace App\Listeners;

use App\Events\ProductConsesionado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

use App\Models\Registro;
class RegistrarConcesion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductConsesionado  $event
     * @return void
     */
    public function handle(ProductConsesionado $event)
    {
        Registro::create[
            [
            'quien' => Auth::user()->nombre,
            'accion' => 'Consesiono un producto',
            'que' => $event->Producto->nombre."-".$event->Product->descripcion
            ]
        ];
    }
}
