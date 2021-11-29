@extends('layouts.app')
@section('content')
<div class="row d-flex justify-content-center align-items-center h-100" name="content">
	<div class="col-lg-12 col-xl-11">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title text-center">Registrarse</h2>
			</div>
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
						<form class="mx-1 mx-md-4" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input id="inputName" type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
									<label class="form-label" for="inputName">Nombre</label>
								</div>
							</div>
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input type="text" class="form-control" placeholder="Apellido Paterno" id="apellido_paterno" name="apellido_paterno">
									<label class="form-label" for="apellido_paterno">Apellido Paterno</label>
								</div>
							</div>
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input type="text" class="form-control" placeholder="apellido materno" id="apellido_materno" name="apellido_materno">
									<label class="form-label" for="apellido_materno">Apellido Materno</label>
								</div>
							</div>
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="input-group form-group">
									<input type="file" class="form-control" id="imagen" name="imagen">
								</div>
							</div>
							@auth
								@if (Auth::user()->rol == 'Supervisor')
								<div class="d-flex flex-row align-items-center mb-2">
									<div class="input-group form-group">
										<select name="rol" id="rol" class="form-control">
											<option selected disabled>Selecciona el tipo de Usuario</option>
											<option value="Supervisor">Supervisor</option>
											<option value="Encargado">Encargado</option>
											<option value="Contador">Contador</option>
											<option value="Cliente">Cliente</option>
										</select>
									</div>
								</div>
								@endif
								@if (Auth::user()->rol == 'Encargado')
								<div class="d-flex flex-row align-items-center mb-2">
									<div class="input-group form-group">
										<select name="rol" id="rol" class="form-control">
											<option selected disabled>Select type of user</option>
											<option value="Encargado">Encargado</option>
											<option value="Contador">Contador</option>
											<option value="Cliente">Cliente</option>
										</select>
									</div>
								</div>
								@endif
							@endauth
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input type="text" class="form-control" placeholder="Correo Eléctronico" id="correo" name="correo">
									<label class="form-label" for="correo">Correo Eléctronico</label>
								</div>
							</div>
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input type="password" class="form-control" placeholder="Contraseña" id="password" name="password">
									<label class="form-label" for="password">Contraseña</label>
								</div>
							</div>
							<div class="d-flex flex-row align-items-center mb-2">
								<div class="form-floating flex-fill">
									<input type="password" class="form-control" placeholder="Confirmar contraseña" id="password2" name="password2">
									<label class="form-label" for="password2">Confirmar contraseña</label>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Registrarse" class="btn btn-primary float-right login_btn">
							</div>
						</form>
					</div>
						<div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
							<img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
