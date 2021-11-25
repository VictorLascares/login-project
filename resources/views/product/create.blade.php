@extends('layouts.app')

@section('content')
    <div class=" mt-4 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <h1 class="card-title text-center">Create New Product</h1>
                    <form method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Product Name" name="name">
                            <label for="floatingInput">Product Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Product description" name="descripcion">
                            <label for="floatingInput">Product Descripcion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" class="form-control" id="floatingInput" placeholder="Product Price" name="price">
                            <label for="floatingInput">Product Price</label>
                        </div>
                        <div class="input-group form-group mb-3">
                            <input type="file" class="form-control" id="imagen" name="imagen">
					    </div>
                        <div class="form-floating mb-3">
                            <select name="category_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Category</label>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-lg btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
