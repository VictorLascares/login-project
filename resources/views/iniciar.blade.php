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
        @if (Auth::user()->rol =='Supervisor')

        @endif
    @endauth
@endsection
