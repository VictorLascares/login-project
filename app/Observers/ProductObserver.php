<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        Registro::create(
            [
            'quien' => Auth::user()->nombre,
            'accion' => 'Agregar un producto',
            'que' => $product->name."-".$product->descripcion,
            'product_id' => $product->id
            ]
        );
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {

        Registro::create(
            [
            'quien' => Auth::user()->nombre,
            'accion' => 'Modifico un producto',
            'que' => $product->name."-".$product->descripcion,
            'product_id' => $product->id
            ]

        );
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        Registro::create(
            [
            'quien' => Auth::user()->nombre,
            'accion' => 'Borró un producto',
            'que' => $product->name."-".$product->descripcion,
            'product_id' => $product->id
            ]

        );
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
