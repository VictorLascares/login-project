@extends('layouts.app')
@section('content')

    @auth
        @if (Auth::user()->rol =='Cliente')
            <form method="POST" action="/estado/{{Auth::user()->id}}/Comprador">
                @csrf
                <button type="submit">Comprar</button>
            </form>
            <form method="POST" action="/estado/{{Auth::user()->id}}/Vendedor">
                @csrf
                <button type="submit">Vender</button>
            </form>

        @endif
   
		@if(Auth::user()->rol == 'Supervisor')
		<div class="row">
			<div class="col-xl-6 col-md-5 col-sm-4">
			<div class="card text-white bg-primary mb-3" style="max-width: 20rem; float:rigth; margin: 10px;" >
			<div class="card-header"><h3>Usuarios registrados</h1></div>
			<div class="card-body">
		  		<h5 class="card-title">{{$contador}}  </h5>  
			</div>
			</div>
			</div>
			<div class="">
			<div class="card text-white bg-primary mb-3" style="max-width: 20rem; float:rigth; margin: 10px;" >
			<div class="card-header"><h3>Transacciones</h1></div>
			<div class="card-body">
				<h5 class="card-title">Primary card title</h5>
			
			</div>
			</div>
			</div>
			<div class="">
			<div class="card text-white bg-primary mb-3" style="max-width: 20rem; float:rigth; margin: 10px;" >
			<div class="card-header"><h3>Propuestas</h1></div>
			<div class="card-body">
				<h5 class="card-title">Primary card title</h5>
					 
			</div>
			</div>
			</div>
			</div>
				<a href="/users">
					<button type="button" class="btn btn-primary">Usuarios</button>
				</a>
			@endif
@endauth
@endsection

