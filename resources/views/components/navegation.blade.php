<div class="align-items-center navbar navbar-expand-lg navbar-light bg-light py-0 ">
    <div class="container-fluid navegacion py-2">
        <a class="navbar-brand" href="/iniciar">Online<spam class="fw-bold">Market</spam></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-end" id="navbarTogglerDemo02">
            <ul class="align-items-center w-100 navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->rol == 'Contador')
                    <div class="nav-item">
                        <a class="nav-link" href="{{url('compras')}}" method="POST">Compras</a>
                    </div>
                    @endif
                    @if (Auth::user()->rol == 'Cliente')
                        <div class="nav-item">
                            <a class="nav-link" href="/estado/{{Auth::user()->id}}/Comprador" method="POST">Comprar</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/estado/{{Auth::user()->id}}/Vendedor" method="POST">Vender</a>
                        </div>
                    @endif
                    @if (Auth::user()->rol == 'Encargado' || Auth::user()->rol =='Supervisor' || Auth::user()->rol == 'Contador')
                        <div class="nav-item">
                            <a class="nav-link" href="/users">
                                Usuarios
                            </a>
                        </div>
                        @if (Auth::user()->rol != 'Contador')
                            <div class="nav-item">
                                <a class="nav-link" href="/products">
                                    Productos
                                </a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="/categories">
                                    Categorias
                                </a>
                            </div>
                        @endif


                    @endif

                    <div class="w-100 d-flex align-items-center justify-content-end">
                        <div class="nav-item me-md-2 my-2 my-md-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="inputDarkMode">
                                <label class="form-check-label" for="inputDarkMode">Modo Oscuro</label>
                            </div>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="/salir">SALIR</a>
                        </div>
                        <div class="nav-item me-md-2">
                            <span class="nav-link">
                                {{Auth::user()->nombre}} {{Auth::user()->apellido_paterno}}
                            </span>
                        </div>
                        <img src="{{ asset("fotos/".Auth::user()->imagen) }}" style="max-width: 45px" class="rounded-circle" alt="Imagen de Usuario">
                    </div>
                @endauth

                @guest
                    <div class="nav-item">
                        <a class="nav-link" href="/products">
                            Productos
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="/categories">
                            Categorias
                        </a>
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <div class="d-flex align-items-center flex-md-row flex-column">
                            <div class="nav-item me-md-2 my-2 my-md-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="inputDarkMode">
                                    <label class="form-check-label" for="inputDarkMode">Modo Oscuro</label>
                                </div>
                            </div>
                            <div class="nav-item me-md-2 my-2 my-md-0">
                                <a class="" href="/register">REGISTRARSE</a>
                            </div>
                            <div class="nav-item">
                                <a class="btn btn-primary" href="/login">INICIAR SESIÓN</a>
                            </div>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</div>
