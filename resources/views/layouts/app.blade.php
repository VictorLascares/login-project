<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<title>Hello, world!</title>
<link rel="shortcut icon" href="#" type="image/x-icon">
<style type="text/css">
    #overlay {
        position: fixed; /* Sit on top of the page content */
        display: none; /* Hidden by default */
        width: 100%; /* Full width (cover the whole page) */
        height: 100%; /* Full height (cover the whole page) */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5); /* Black background with opacity */
        z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
        cursor: pointer; /* Add a pointer on hover */
        margin-top: 1rem;}
        html {
        position: relative;
        min-height: 100%;
        }
        body {
        margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Set the fixed height of the footer here */
        line-height: 60px; /* Vertically center the text there */
        }

        .container {
        width: auto;
        padding: 0 15px;
        }
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.33);
        }
        .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
            color: #000;
        }
        .clasificacion {
            direction: rtl;/* right to left */
            unicode-bidi: bidi-override;/* bidi de bidireccional */
            text-align: center;
        }
        .clasificacion label {
            font-size: 20px;
        }
        .clasificacion input[type = "submit"] {
            display: none;

        }
        .clasificacion input[type = "radio"]:checked ~ label {
            color: orange;
        }
        .clasificacion label {
            color:grey;
        }
        .clasificacion label:hover,
        .clasificacion label:hover ~ label {
            color: orange;
        }
        .clasificacion label:hover {
            cursor: pointer;
        }
}
</style>
</head>
<body>
    <header>
        <x-navegation />
    </header>
    <main class="contenidoPrincipal">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
