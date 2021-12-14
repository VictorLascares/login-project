@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h1 class="card-title">Compras</h1>
        </div>
        <div class="card-body">
            @foreach ($compras as $compra)
                
            @endforeach
        </div>
    </div>
@endsection