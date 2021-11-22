<?php

namespace App\Listeners;

use App\Events\ProductConsesionado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificarConcesion
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
        //Enviar un correo al cliente para avisarle que su producto ya esta concesionado
    }
}
