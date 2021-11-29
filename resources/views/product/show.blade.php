@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title">Product</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>
                <div class="form-group">
                    <strong>Existence:</strong>
                    {{ $product->existencia }}
                </div>
                <div class="form-group">
                    <strong>Price:</strong>
                    {{ $product->price }}
                </div>
                <div class="form-group">
                    <strong>Category:</strong>
                    {{ $category['name'] }}
                </div>
                @auth
                    @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Comprador')
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-column">
                                <label for="product_question">Do you have a question?</label>
                                <input type="text" name="question" id="product_question" placeholder="Question">
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
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h2 class="card-title">Preguntas</h2>
            </div>
            <div class="card-body">
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
    </div>
</div>
<script type="text/javascript" >

</script>
@endsection
