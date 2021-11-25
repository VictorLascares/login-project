
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" href="../../css/app.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100" name="content">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
			</div>
			<div class="card-body">
				<form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" id="nombre" name="nombre">

					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="apellido paterno" id="apellido_paterno" name="apellido_paterno">

					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="apellido materno" id="apellido_materno" name="apellido_materno">

					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="file" class="form-control" id="imagen" name="imagen">
					</div>
                    @auth
                        @if (Auth::user()->rol == 'Supervisor')
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-think fa-users"></i></span>
                                </div>
                                <select name="rol" id="rol" class="form-control">
                                    <option selected disabled>Select type of user</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Encargado">Encargado</option>
                                    <option value="Contador">Contador</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                            </div>
                        @endif
                        @if (Auth::user()->rol == 'Encargado')
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-think fa-users"></i></span>
                            </div>
                            <select name="rol" id="rol" class="form-control">
                                <option selected disabled>Select type of user</option>
                                <option value="Encargado">Encargado</option>
                                <option value="Contador">Contador</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>
                        @endif
                    @endauth

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-solid fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="correo" id="correo" name="correo">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="contraseña" id="password" name="password">
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="repetir contraseña" id="password2" name="password2">
					</div>

					<div class="form-group">
						<input type="submit" value="Sigup" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
