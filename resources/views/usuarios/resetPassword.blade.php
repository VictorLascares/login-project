@extends('layouts.app')
@section('content')

@auth
@if (Auth::user()->rol == 'Supervisor' or Auth::user()->rol == 'Encargado')

         <div class="row  h-25 w-75 p-3">
            <h1>Reestablecer contraseña</h1>
            <h1>{{$user->nombre}}</h1>
    <form method="POST" action="{{ route('users.update',$user->id) }}">
            @csrf
           @method('PUT')
    <div class="form-group">
        <label for="name_id" class="control-label">Nueva contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="">
    </div>
    <div class="form-group">
        <label for="name_id" class="control-label">Reescribir contraseña</label>
        <input type="password" class="form-control" id="password2" name="password2" placeholder="">
    </div>
    <br>
    <div class="form-group"> <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
</div>
@endif
@endauth

@endsection
