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
    <div class="form-group">
        <a href="/users" class="btn btn-primary">Atras</a>
    </div>
</div>
@endsection
