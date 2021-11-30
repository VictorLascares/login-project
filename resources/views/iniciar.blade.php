@extends('layouts.app')
@section('content')

    @auth
        @if (Auth::user()->rol =='Cliente')

                <a href="/estado/{{Auth::user()->id}}/Comprador" method="POST">
                    <button type="button" class="btn btn-primary">Comprar</button>
                </a>
                <a href="/estado/{{Auth::user()->id}}/Vendedor" method="POST">
                    <button type="button" class="btn btn-primary">Vender</button>
                </a>
        @endif

        @if (Auth::user()->rol =='Encargado')
            <a href="/users">
                <button type="button" class="btn btn-primary">Usuarios</button>
            </a>
            <a href="/products">
                <button type="button" class="btn btn-primary">Productos</button>
            </a>
            <a href="/categories">
                <button type="button" class="btn btn-primary">Categorias</button>
            </a>
            <div id="overlay">
                <h2>Selecciona la forma de Pago</h2>
            </div>

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

			</div>
			</div>
			</div>
            <div class="card-body">
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category</th>
                                    @auth
                                        @if (Auth::user()->estado != 'Vendedor')
                                            <th scope="col">Vendedor</th>
                                        @else
                                            <th scope="col">Motivo</th>
                                        @endif
                                    @endauth
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    @foreach ($categories as $category)
                                    @if ($category->id == $product->category_id)
                                        <td>
                                            @csrf
                                            <a type="submit" href="{{ route('categories.show',$category->id)}}" >{{ $category->name }}</a>
                                        </td>
                                    @endif
                                    @endforeach

                                    @auth
                                        @if (Auth::user()->estado != 'Vendedor')
                                            <td>{{Auth::user()->nombre($product->user_id)}}</td>
                                        @else
                                            @if ($product->concesionado == '0')
                                                <td>{{$Product->motivo}}</td>
                                            @else
                                                @if ($product->concesionado == '1')
                                                    <td>Valido para venta</td>
                                                @else
                                                    <td>---</td>
                                                @endif
                                            @endif
                                        @endif
                                        @if (Auth::user()->rol == "Cliente")
                                            @if (Auth::user()->estado == "Comprador")
                                                @if ($product->existencia >= '1')
                                                    <td>Activo</td>
                                                @else
                                                    <td>Pausado</td>
                                                @endif
                                            @else
                                                @if ($product->concesionado == '1')
                                                    <td>Aceptado</td>
                                                @else
                                                    @if ($product->concesionado == '0')
                                                        <td>Rechazado</td>
                                                    @else
                                                        <td>Pendiente</td>
                                                    @endif
                                                @endif
                                            @endif
                                        @else
                                            @if (Auth::user()->rol == "Encargado")
                                                <td>Pendiente</td>
                                            @else
                                                @if ($product->concesionado == '1')
                                                    <td>Aceptado</td>
                                                    @else
                                                        @if ($product->concesionado == '0')
                                                            <td>Rechazado</td>
                                                        @else
                                                            <td>Pendiente</td>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endauth
                                    @guest
                                        @if ($product->existencia >= '1')
                                            <td>Activo</td>
                                        @else
                                            <td>Pausado</td>
                                        @endif
                                    @endguest
                                    <td class="d-flex justify-content-center">
                                        <form method="POST" action="{{route('products.destroy',$product->id)}}">
                                            <a href="{{route('products.show',$product->id)}}" class="btn btn-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </a>
                                            @can('update', $product)
                                                @if (Auth::user()->estado == 'Vendedor')
                                                    @if ($product->concesionado != '1')
                                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endcan

                                            @auth
                                                @if (Auth::user()->rol == 'Cliente' && Auth::user()->estado == 'Comprador')
                                                @else
                                                    @if (Auth::user()->rol == 'Cliente')
                                                        @if ($product->concesionado != '1')
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                    @else
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                @endif
                                            @endauth
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

			</div>
				<a href="/users">
					<button type="button" class="btn btn-primary">Usuarios</button>
				</a>
                <a href="/products">
					<button type="button" class="btn btn-primary">Productos</button>
				</a>
                <a href="/categories">
					<button type="button" class="btn btn-primary">Categorias</button>
				</a>
			@endif
@endauth
@guest
    <a href="/products">
        <button type="button" class="btn btn-primary">Productos</button>
    </a>
    <a href="/categories">
        <button type="button" class="btn btn-primary">Categorias</button>
    </a>
@endguest
@endsection


