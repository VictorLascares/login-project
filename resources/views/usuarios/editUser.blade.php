
{{-- <!<!DOCTYPE> --}}
@extends('layouts.app')
@section('content')
        
        <div class="row  h-25 w-75 p-3">
            <h1>Actualizar datos de un usuario</h1>
        <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
    <div class="form-group"> 
        <label for="name_id" class="control-label">Nombre</label>
        <input type="text" class="form-control" id="name_id" name="nombre" placeholder="">
    </div>    

    <div class="form-group"> 
        <label for="street1_id" class="control-label">Primer apellido</label>
        <input type="text" class="form-control" id="p_apelido_id" name="p_apellido" placeholder="">
    </div>                    
                            
    <div class="form-group"> 
        <label for="street2_id" class="control-label">Segundo apellido</label>
        <input type="text" class="form-control" id="s_apellido_id" name="s_apellido" placeholder="">
    </div>    

    <div class="form-group"> 
        <label for="city_id" class="control-label">Correo electronico</label>
        <input type="text" class="form-control" id="email_id" name="email" placeholder="">
    </div>                                    
    
    <div class="mb-3">
        <label for="formFile" class="form-label">Imagen</label>
    <input type="file" class="form-control" id="imagen" name="imagen">

      </div>      
    <br>
    <div class="form-group"> 
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>     

</form>
</div>
@endsection