<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Encargado</title>
</head>
<body>
    <div class="container ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Encargado</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="card w-100" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Buscar Producto</h5>
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre del producto" aria-label="Nombre del Producto" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="button">Buscar</button>
                    </div>    
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-primary" scope="col">#</th>
                        <th class="table-primary" scope="col">Nombre</th>
                        <th class="table-primary" scope="col">Precio</th>
                        <th class="table-primary" scope="col">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Coca Cola</td>
                        <td>16.00</td>
                        <td>Refrescos</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
