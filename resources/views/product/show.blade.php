@extends('layouts.app')

@section('content')

        <div class="card my-3">
            <div class="row g-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Producto</h2>
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Regresar</a>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset("fotos/products/".$product->imagen) }}" class="card-img-top" alt="Imagen de Producto">
                </div>

                <div class="col-md-8">
                    <div class="card-body d-flex align-items-center">
                        <div class="fs-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    {{ $product->name }}
                                </div>
                                <div class="form-group">
                                    <strong>Existencia:</strong>
                                    {{ $product->existencia }}
                                </div>
                                <div class="form-group">
                                    <strong>Precio: </strong>
                                    ${{ $product->price }}
                                </div>
                                <div class="form-group">
                                    <strong>Categoria:</strong>
                                    {{ $category['name'] }}
                                </div>

                                
                                @auth
                                @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Comprador')
                                <div class="form-group">
                                    <strong>Forma de Pago</strong>
                                    <div class="input-group">
                                        <button id="pago-linea" class="btn btn-success">En Linea</button>
                                        <button id="pago-banco" class="btn btn-primary">Banco</button>
                                    </div>
                                </div>
                                @if ($compra != null)
                                            @if ($compra->estado == 'Entregado')
                                            <form class="d-flex align-items-center" method="POST" action="/calificado/{{$compra->id}}">
                                                @csrf
                                                <strong>Calificación: </strong>
                                                <div class="clasificacion">
                                                    <input id="radio1" type="submit" name="estrellas" value="5"><!--
                                                    --><label for="radio1">★</label><!--
                                                --><input id="radio2" type="submit" name="estrellas" value="4"><!--
                                                --><label for="radio2">★</label><!--
                                                --><input id="radio3" type="submit" name="estrellas" value="3"><!--
                                                --><label for="radio3">★</label><!--
                                                --><input id="radio4" type="submit" name="estrellas" value="2"><!--
                                                --><label for="radio4">★</label><!--
                                                --><input id="radio5" type="submit" name="estrellas" value="1"><!--
                                                --><label for="radio5">★</label>
                                                </div>
                                            </form>
                
                                        @endif
                                        @endif
                                        
                                        @if ($product->existencia >= 1)
                                            <form id="metodo-pago" class="mt-4" id="accionesCliente" method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="en-linea" style="display: none">
                                                    <div class="input-group en-linea">
                                                        <input style="width: 20rem" type="number" max="{{$product->existencia}}"  min="1" placeholder="Cantidad" name="cantidadLinea">
                                                        <button class="btn btn-primary" type="submit">Pagar</button>
                                                    </div>
                                                </div>
                                                <div class="banco" style="display: none">
                                                    <div class="d-flex flex-column">
                                                        <input type="file" class="form-control mb-3" id="ticket" name="ticket">
                                                        <div class="input-group">
                                                            <input style="width: 20rem" type="number" max="{{$product->existencia}}"  min="1" placeholder="Cantidad" name="cantidad">
                                                            <button class="btn btn-primary" type="submit">Pagar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                    
                                    @can('consignar', $product)
                                            <button id="consignar"  class="btn btn-success text-uppercase">Concesionar</button>
                                            <button id="noConsignar" class="btn btn-danger text-uppercase">No Concesionar</button>
                                            <form class="mt-2" id="#overlay" class="row-reverse" method="POST" action="/product/{{$product->id}}/consignar">
                                                @method('PUT')
                                                @csrf
                                            </form>
                                        @endcan
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card mt-3">
            <div class="card-header">
                <h2 class="card-title">Preguntas</h2>
            </div>
            <div class="card-body">
                @auth
                    @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Comprador') 
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="form-floating d-flex flex-column">
                                <input class="form-control" type="text" name="question" id="product_question" placeholder="Question">
                                <label for="product_question">¿Tienes alguna pregunta?</label>
                            </div>
                            <div class="d-none">
                                <input type="text" name="product_id" value="{{ $product->id }}" id="product_question" placeholder="Question">
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <input class="btn btn-primary" type="submit" value="Send">
                            </div>
                        </form>
                    @endif
                @endauth
                @foreach ($questions as $question)
                    @if ($question->answer == '')
                        <p>{{ $question->question }}</p>
                        @auth
                            @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Vendedor')
                                <form method="POST" action="{{ route('questions.update',$question->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column">

                                        <input type="text" name="answer" placeholder="Responder">
                                    </div>

                                    <div class="d-flex justify-content-end mt-2">
                                        <input class="btn btn-primary btn-answer" type="submit" value="Send">
                                    </div>
                                </form>
                            @endif
                        @endauth
                    @else
                    <div class="d-flex flex-column">
                        <label for="{{$question->id}}">{{ $question->question }}</label>
                        <input type="text" name="answer" id="{{$question->id}}" disabled value="{{$question->answer}}">
                    </div>
                    @endif
                @endforeach
            </div>


        </div>
        @auth
            @if (Auth::user()->rol == 'Supervisor')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Vendedor</th>
                                    <th scope="col">Porcentaje</th>
                                    <th scope="col">Comprador</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha de creacion</th>
                                </tr>
                            </thead>
                            @foreach ($compras as $compra)
                                <tbody class="text-center">

                                        <th scope="row">{{ $l++ }}</th>
                                        <td>
                                            {{Auth::user()->nombre($product->user_id)}}
                                        </td>
                                        <td>
                                            {{$product->porcentaje}}%
                                        </td>
                                        <td>{{Auth::user()->nombre($compra->user_id)}}</td>
                                        <td>{{$compra->cantidad}}</td>
                                        <td>{{$compra->estado}}</td>
                                        <td>{{$compra->created_at}}</td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif
        @endauth

<script type="text/javascript" >
    const overlay = document.getElementById('#overlay');
    if(overlay!==null){
        const consignar = document.querySelector('#consignar')
        const noConsignar = document.querySelector('#noConsignar')
        const entrada = document.createElement("INPUT");
        const submit = document.createElement("INPUT");
        submit.type = 'submit'
        submit.classList.add('btn')
        submit.classList.add('btn-primary')
        submit.value = 'Entregar';
        entrada.classList.add('me-2')
        overlay.appendChild(submit);
        overlay.style.display = "none";

        consignar.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarInputNumber();
        })
        noConsignar.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarInputText();
        })
        function mostrarInputNumber(){
            noConsignar.disabled = false;
            consignar.disabled = true;
            entrada.type = "number";
            entrada.name = "porcentaje";
            entrada.placeholder = "Porcentaje";
            overlay.appendChild(entrada);
            overlay.style.display = "flex";
            overlay.style.flexDirection = "row-reverse"
        }
        function mostrarInputText(){
            consignar.disabled = false;
            noConsignar.disabled = true;
            entrada.type = "text";
            entrada.name = "motivo";
            overlay.appendChild(entrada);
            entrada.placeholder = "Motivo";
            overlay.appendChild(entrada);
            overlay.style.display = "flex";
            overlay.style.flexDirection = "row-reverse"
        }
    }
    // Botones
    const enLinea = document.querySelector('#pago-linea')
    const banco = document.querySelector('#pago-banco')
    // Formularios
    const formBanco = document.querySelector('.banco')
    const formEnLinea = document.querySelector('.en-linea')
    const metodo = document.querySelector('#metodo-pago')
    enLinea.addEventListener('click', function(){
        formBanco.style.display = 'none'
        formEnLinea.style.display = 'block'
        metodo.action= "{{url('comprar/linea',$product->id)}}"
    })

    banco.addEventListener('click', function(){
        formEnLinea.style.display = 'none'
        formBanco.style.display = 'block'
        metodo.action= "{{url('comprar/banco',$product->id)}}"
    })
    
</script>
@endsection
