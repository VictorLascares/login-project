@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="h-100">
    
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title text-center">Acceso al Mercado</h1>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckIndeterminate">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        Remember me
                                    </label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                            </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            Don't have an account?<a href="/register">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection