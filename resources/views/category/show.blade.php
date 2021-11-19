@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <span class="card-title">Show Category</span>
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                </div>
            </div>

            <div class="card-body">
                
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $category->name }}
                </div>
                <div class="form-group">
                    <strong>Active:</strong>
                    @if ($category->active)
                        Yes
                    @else
                        No
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection