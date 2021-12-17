@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="">
                    <h2 class="card-title">Categoria</h2>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                </div>
            </div>

            <div class="card-body">
                
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {{ $category->name }}
                </div>
                <div class="form-group d-flex">
                    <strong class="me-1">Estado:</strong>
                    @if ($category->active)
                        <p class="text-success">Activa</p>
                    @else
                        <p class="text-danger">Inactiva</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection