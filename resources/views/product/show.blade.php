@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title">Show Product</h2>
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
                    <strong>Price:</strong>
                    {{ $product->price }}
                </div>
                <div class="form-group">
                    <strong>Category:</strong>
                    {{ $category['name'] }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection