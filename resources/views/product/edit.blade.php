@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center mt-4">
        <div class="col-md-6">
            <div class="card shadow bg-body rounded">
                <div class="card-header">
                    <h1 class="card-title text-center">Edit Product</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('products.update',$product->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Product Name" name="name" value="{{ $product->name }}">
                            <label for="floatingInput">Product Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Description" name="descripcion" value="{{ $product->descripcion }}">
                            <label for="floatingInput">Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Existence" name="existencia" value="{{ $product->existencia }}">
                            <label for="floatingInput">Existence</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" class="form-control" id="floatingInput" placeholder="Product Price" name="price" value="{{ $product->price}}">
                            <label for="floatingInput">Product Price</label>
                        </div>
                        <div class="input-group form-group mb-3">
                            <input type="file" class="form-control" id="imagen" name="imagen">
					    </div>
                        <div class="form-floating mb-3">
                            <select name="category_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option disabled>Select a category</option>
                                @foreach ($categories as $category)
                                    <option @if ($category->id == $product->category_id)
                                        selected
                                    @endif value="{{ $category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Category</label>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-lg btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
