@extends('layouts.app')
@section('content')

<div class="input-group form-group">
    @auth
        <form id="formulario_busqueda" action="/product/{null}" >
            <i class="fas fa-think fa-users"></i>
            <select  class="select-category" name="categoria" class="form-control">
                <option selected>All Categories</option>
                @foreach ($categories as $category)
                    <option class="categoria" id="{{$category->id}}" value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="text" placeholder="Product name" id="nombre" name="name">
            <button type="submit" class="bi bi-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
    @endauth
    @guest
    <form method="POST" action="/product/{null}">
        @csrf
            <input type="text" placeholder="Product name" id="name" name="name">
            <button type="submit" class="bi bi-search" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
    @endguest
</div>

<div class="row pt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-lg-flex justify-content-between align-items-center">
                    <h2 class="card-title text-center">
                        Products
                    </h2>
                    @if ($user == 'Cliente')
                        @if (Auth::user()->estado == 'Vendedor')
                            <form>
                                @csrf
                                <a href="{{ route('products.create')}}" class="btn btn-primary">New Product<a/>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset("fotos/products/".$product->imagen) }}" class="card-img-top" alt="Imagen de Producto">
                                <div class="card-body">
                                    <h3 class="text-center">{{$product->name}}</h3>
                                    <p><span class="fw-bold">Precio: </span>${{$product->price}}</p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            @foreach ($categories as $category)
                                                @if ($category->id == $product->category_id)
                                                    @csrf
                                                    <form action="{{ route('categories.show',$category->id)}}">
                                                        <button class="btn btn-primary" type="submit">{{ $category->name }}</button>
                                                    </form>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <form method="POST" action="{{route('products.destroy',$product->id)}}">
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
                                            <form action="{{route('products.show',$product->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            @can('update', $product)
                                                @if (Auth::user()->estado == 'Vendedor')
                                                    @if ($product->concesionado != '1')
                                                        <form action="{{ route('products.edit', $product->id) }}">
                                                            <button class="btn btn-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endcan
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                @auth
                                    @if (Auth::user()->estado != 'Vendedor')
                                        <p><span class="fw-bold">Vendedor: </span>{{Auth::user()->nombre($product->user_id)}}</p>
                                    @else
                                        @if ($product->concesionado == '0')
                                            <p>{{$product->motivo}}</p>
                                        @else
                                            @if ($product->concesionado == '1')
                                                <p class="text-center text-success">Valido para venta</p>
                                            @else
                                                <p>---</p>
                                            @endif
                                        @endif
                                    @endif
                                    @if (Auth::user()->rol == "Cliente")
                                        @if (Auth::user()->estado == "Comprador")
                                            @if ($product->existencia >= '1')
                                                <p><span class="fw-bold">Estado: </span> Activo</p>
                                            @else
                                                <p><span class="fw-bold">Estado: </span>Pausado</p>
                                            @endif
                                        @else
                                            @if ($product->concesionado == '1')
                                                <p><span class="fw-bold">Concesionado: </span>Aceptado</p>
                                            @else
                                                @if ($product->concesionado == '0')
                                                    <p><span class="fw-bold">Concesionado: </span>Rechazado</p>
                                                @else
                                                    <p><span class="fw-bold">Concesionado: </span>Pendiente</p>
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        @if (Auth::user()->rol == "Encargado")
                                            <p><span class="fw-bold">Concesionado: </span>Pendiente</>
                                        @else
                                            @if ($product->concesionado == '1')
                                                <p><span class="fw-bold">Concesionado: </span> Aceptado</p>
                                            @else
                                                @if ($product->concesionado == '0')
                                                    <p><span class="fw-bold">Concesionado: </span>Rechazado</p>
                                                @else
                                                    <p><span class="fw-bold">Concesionado: </span>Pendiente</p>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endauth
                                @guest
                                    @if ($product->existencia >= '1')
                                        <p><span class="fw-bold">Estado: </span>Activo</p>
                                    @else
                                        <p><span class="fw-bold">Estado: </span>Pausado</p>
                                    @endif
                                @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
    const categories = document.querySelectorAll('.categoria');
    const form = document.querySelector('#formulario_busqueda')
    console.log(form);
    categories.forEach( category => {
        category.addEventListener('click',(e) => {
            form.action = "/product/".concat(e.target.id)
        })
    });
</script>
@endsection
