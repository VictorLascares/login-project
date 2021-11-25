<!<!DOCTYPE>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body>
        <div class="row  h-25 w-75 p-3">
            <h1>Actualizar datos de un usuario</h1>
        <form method="POST">
            @csrf
            <div class="form-group"> <!-- State Button -->
                <label for="user_name" class="control-label">Selecciona el usuario</label>
                <select class="form-control" id="user_name">
                    @foreach($usuarios as $usuario)
                         <p>{{$usuario}}</p>
                    @endforeach
                </select>                    
            </div>
    <div class="form-group"> <!-- Full Name -->
        <label for="name_id" class="control-label">Nombre</label>
        <input type="text" class="form-control" id="name_id" name="nombre" placeholder="">
    </div>    

    <div class="form-group"> <!-- Street 1 -->
        <label for="street1_id" class="control-label">Primer apellido</label>
        <input type="text" class="form-control" id="p_apelido_id" name="p_apelido" placeholder="">
    </div>                    
                            
    <div class="form-group"> <!-- Street 2 -->
        <label for="street2_id" class="control-label">Segundo apellido</label>
        <input type="text" class="form-control" id="s_apellido_id" name="s_apellido" placeholder="">
    </div>    

    <div class="form-group"> <!-- City-->
        <label for="city_id" class="control-label">Correo electronico</label>
        <input type="text" class="form-control" id="email_id" name="email" placeholder="">
    </div>                                    
    
    <div class="mb-3">
        <label for="formFile" class="form-label">Imagen</label>
        <input class="form-control" type="file" id="formFile">
      </div>      
    <br>
    <div class="form-group"> <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>     

</form>
</div>
    </body>
</html>