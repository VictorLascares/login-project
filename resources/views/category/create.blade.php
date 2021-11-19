@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <h1 class="card-title text-center">Create New Category</h1>
                    <form method="POST" action="{{ route('categories.store')}}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Category Name" name="name">
                            <label for="floatingInput">Category Name</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" checked id="activeCheckbox" name="active">
                            <label class="form-check-label" for="activeCheckbox">
                                Active
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-lg btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    const checkbox = document.querySelector('#activeCheckbox');
    checkbox.value = '1'
    checkbox.addEventListener('click', () => {
        if (checkbox.checked) {
            checkbox.value = '1'
        } else {
            checkbox.value = '0'
        }
        console.log(checkbox);
    });
</script>
@endsection