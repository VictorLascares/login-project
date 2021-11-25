<?php

namespace App\Listeners;


use App\Events\ProductConcesionado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

use App\Models\Registro;
use App\Models\User;
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
     * @param  ProductConcesionado  $event
     * @return void
     */
    public function handle(ProductConcesionado $event)
    {
        Registro::create(
            [
            'quien' => Auth::user()->nombre,
            'accion' => 'Consesiono un producto',
            'que' => $event->product->name."-".$event->product->descripcion,
            'product_id' => $event->product->id
            ]

        );
    }
}
