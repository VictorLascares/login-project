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
    <div class="form-group">
        <a href="/users" class="btn btn-primary">Atras</a>
    </div>


</div>
@endsection
