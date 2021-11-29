<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/iniciar">Online<spam class="fw-bold">Market</spam></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-end" id="navbarTogglerDemo02">
            <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <div class="w-100 d-flex align-items-center justify-content-end">
                        <div class="nav-item">
                            <a class="nav-link" href="/salir">SALIR</a>
                        </div>
                        <div class="nav-item">
                            {{Auth::user()->nombre}} - ({{Auth::user()->rol}})
                        </div>
                        <img src="{{ asset("fotos/".Auth::user()->imagen) }}" style="max-width: 45px" class="rounded-circle" alt="Imagen de Usuario">
                    </div>
                @endauth
                @guest
                    <div class="w-100 d-flex justify-content-end">
                        <div class="d-flex align-items-center flex-md-row flex-column">
                            <div class="nav-item me-md-2 my-2 my-md-0">
                                <a class="" href="/register">REGISTRARSE</a>
                            </div>
                            <div class="nav-item ">
                                <a class="btn btn-primary" href="/login">INICIAR SESIÓN</a>
                            </div>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</div>
