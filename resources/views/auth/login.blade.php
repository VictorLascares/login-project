@extends('layouts.app')
@section('content')
<div class="mt-4 d-flex justify-content-center h-100" name="content">
	<div class="card">
		<div class="card-header">
			<h2 class="card-title text-center">Iniciar Sesión</h2>
		</div>
		<div class="card-body">
			<form action="/validar" method="POST">
				@csrf
				<div class="d-flex flex-row align-items-center mb-2">
					<div class="form-floating flex-fill">
						<input type="email" class="form-control" placeholder="Correo Electrónico" id="correo" name="correo">
						<label class="form-label" for="correo">Correo Electrónico</label>
					</div>
				</div>
				<div class="d-flex flex-row align-items-center mb-2">
					<div class="form-floating flex-fill">
						<input type="password" class="form-control" placeholder="password" id="password" name="password">
						<label class="form-label" for="password">Contraseña</label>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="VALIDAR" class="btn btn-primary login_btn w-100">
				</div>
			</form>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center links">
				Don't have an account?<a href="/register">Sign Up</a>
			</div>
		</div>
	</div>
</div>
@endsection