{{-- <!<!DOCTYPE> --}}
@extends('layouts.app')
@section('content')

    <div class="row  h-25 w-75 p-3">
        <h1>Actualizar datos de un usuario</h1>


    <div class="form-group">
        <label for="name_id" class="control-label">Nombre: {{$user->nombre}} </label>
    </div>

    <div class="form-group">
        <label for="street1_id" class="control-label">Primer apellido: {{$user->apellido_paterno}}</label>

    </div>

    <div class="form-group">
        <label for="street2_id" class="control-label">Segundo apellido: {{$user->apellido_materno}}</label>
    </div>

    <div class="form-group">
        <label for="city_id" class="control-label">Correo electronico: {{$user->correo}}</label>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Imagen</label>
        <img src="{{ asset("fotos/".$user->imagen) }}" alt="Imagen usuario">
    </div>
    <br>
    @auth
        @if (Auth::user()->rol == 'Supervisor')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Fecha alta</th>
                            <th scope="col">Transacciones</th>
                            <th scope="col">Productos</th>
                            <th scope="col">Productos concesionados</th>
                            <th scope="col">Productos comprados</th>
                            <th scope="col">Productos en oferta</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <th scope="row">{{ $l++ }}</th>
                        <th scope="row">{{$user->created_at}}</th>
                        <th scope="row">{{$transacciones}}</th>
                        <th scope="row">{{$productos}}</th>
                        <th scope="row">{{$aceptados}}</th>
                        <th scope="row">{{$comprados}}</th>
                        <th scope="row">{{$oferta}}</th>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if (Auth::user()->rol == 'Contador')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Comprador</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Status</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Vendedor</th>
                                <th scope="col">Porcentaje</th>
                                <th scope="col">Costo unitario</th>
                                <th scope="col">Costo total</th>
                                <th scope="col">Ganancia Vendedor</th>
                                <th scope="col">Ganancia Mercado</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($miscompras as $compra)
                            <tr>
                                <th scope="row">{{ $l++ }}</th>
                                <td>{{Auth::user()->nombre($compra->user_id)}}</td>
                                <td>{{$compra->cantidad}}</td>
                                <td>{{$compra->estado}}</td>
                                @foreach ($productsA as $product)
                                    @if ($product->id == $compra->product_id)
                                        <td>
                                            {{$product->name}}
                                        </td>
                                        <td>
                                            {{Auth::user()->nombre($product->user_id)}}
                                        </td>
                                        <td>
                                            {{$product->porcentaje}}%
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            {{$product->price*$compra->cantidad}}

                                        </td>
                                        {{$costototal+=$product->price*$compra->cantidad}}
                                        <td>
                                            {{$product->price*$compra->cantidad*(100-$product->porcentaje)/100}}
                                        </td>
                                        {{$gananciavendedor+=$product->price*$compra->cantidad*(100-$product->porcentaje)/100}}
                                        <td>
                                            {{$product->price*$compra->cantidad*($product->porcentaje)/100}}
                                        </td>
                                        {{$gananciamercado+=$product->price*$compra->cantidad*($product->porcentaje)/100}}
                                    @endif

                                @endforeach


                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Totales</td>
                                <td>{{$costototal}}</td>
                                <td>{{$gananciavendedor}}</td>
                                <td>{{$gananciamercado}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endauth
    <div class="form-group">
        <a href="/users" class="btn btn-primary">Atras</a>
    </div>
</div>
@endsection
