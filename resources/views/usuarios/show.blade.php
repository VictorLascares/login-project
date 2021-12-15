{{-- <!<!DOCTYPE> --}}
@extends('layouts.app')
@section('content')

    <div class="card mt-4 mb-3">
        <div class="row g-0">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="/users" class="btn btn-primary">Regresar</a>
                </div>
            </div>
            <div class="col-md-4">
                <img class="card-img-top" src="{{ asset("fotos/".$user->imagen) }}" alt="Imagen usuario">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">Usuario</h1>
                    <p for="name_id" class="control-label"><span class="fw-bold">Nombre: </span> {{$user->nombre}} </p>
                    <p for="street1_id" class="control-label"><span class="fw-bold">Apellido Paterno: </span> {{$user->apellido_paterno}}</p>
                    <p for="street1_id" class="control-label"><span class="fw-bold">Apellido Materno: </span> {{$user->apellido_materno}}</p>
                    <p for="street1_id" class="control-label"><span class="fw-bold">Correo Electronico: </span> {{$user->correo}}</p>
                </div>
            </div>
        </div>
    </div>



    @auth
        <div class="">
            @if (Auth::user()->rol == 'Supervisor')
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
            @endif
        @if (Auth::user()->rol == 'Contador')
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
                                            ${{$product->price*$compra->cantidad}}.00
                                        </td>

                                        <td>
                                            ${{$compra->ganancia}}
                                        </td>
                                        <td>
                                            ${{$compra->mercado}}
                                        </td>
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
                <form class="d-flex justify-content-end" action="">
                    <input class="btn btn-primary" type="submit" value="Pagar">
                </form>
            </div>
        @endif
    @endauth
</div>
<script type="text/javascript">


</script>
@endsection
