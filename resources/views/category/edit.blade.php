@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <h1 class="card-title text-center">Edit Category</h1>
                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Category Name" name="name" value="{{ $category->name }}">
                            <label for="floatingInput">Category Name</label>
                        </div>
        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $category->active }}" id="activeCheckbox" name="active" @if ($category->active)
                                checked
                            @endif>
                            <label class="form-check-label" for="activeCheckbox">
                                Active
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-lg btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    const checkbox = document.querySelector('#activeCheckbox');
    checkbox.addEventListener('click', () => {
        if (checkbox.checked) {
            checkbox.value = 1
        } else {
            checkbox.value = 0
        }
    console.log(checkbox);
    });
</script>
@endsection