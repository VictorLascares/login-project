@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h1 class="card-title">Compras</h1>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($compras as $compra)
                @if ($compra->estado == 'Comprado')
                    <div class="col">
                        <div class="card">
                            <img src="{{asset('fotos/tickets/'.$compra->ticket)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center"><span>Estado: </span>{{$compra->estado}}</h5>
                                <form class="d-grid" action="" method="">
                                    <input type="submit" class="btn btn-primary" value="Validar">
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection