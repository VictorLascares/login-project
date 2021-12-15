@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h1 class="card-title">Compras</h1>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($compras as $compra)
                <div class="col">
                    <div class="card">
                        <img src="{{asset('fotos/tickets/'.$compra->ticket)}}" class="card-img-top" alt="Ticket de Compra">
                        <div class="card-body">
                            @foreach ($productos as $producto)
                                @if ($producto->id == $compra->product_id)
                                    <h5 class="card-title text-center"><span>Producto: </span>{{$producto->name}}</h5>
                                    <p><span class="fw-bold">Precio: $</span> {{$producto->price}}</p>
                                @endif
                            @endforeach
                            @foreach ($usuarios as $usuario)
                                @if ($usuario->id == $compra->user_id)
                                    <p><span class="fw-bold">Comprador: </span> {{$usuario->nombre.' '.$usuario->apellido_paterno}}</p>
                                @endif
                            @endforeach
                            <form class="d-grid" action="{{ url('/estado',$compra->id) }}" method="GET">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="Validar">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection