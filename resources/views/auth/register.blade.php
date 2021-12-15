@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('js/busqueda.js')}}">
</script> 
<div class="mt-4 row d-flex justify-content-center align-items-center h-100" name="content">
	<div class="col-lg-12 col-xl-11">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title text-center">Registrarse</h2>
			</div>
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
						<form class="mx-1 mx-md-4" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
							<input type="hidden" id="token" value="{{ @csrf_token() }}">
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
								<div id="invalido">
								<div class="alert alert-danger d-flex align-items-center m-2" role="alert" >
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 " viewBox="0 0 16 16" role="img" aria-label="Danger:">
									  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
									</svg>
								  </div>
								</div>
								<div id="valido">
								  <div  class="alert alert-success d-flex align-items-center m-2" role="alert" >
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 " viewBox="0 0 16 16" role="img" aria-label="Success:">
									  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
									</svg>
								  </div>
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
								<input type="submit" value="Registrarse" class="btn btn-primary float-right login_btn" id="registrar">
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
