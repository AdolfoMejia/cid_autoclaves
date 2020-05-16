<?php 
require_once('./assets/class/class.php');

if(isset($_POST['action']) and $_POST['action'] =='modal' ){
    $a = new work();
    $a->modal($_POST['name'], $_POST['type']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Bootstrap 4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- JS -->
    <script src="./assets/js/funciones.js"></script>
</head>
<body>
    <!-- Modal -->
    <div id="modal"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="http://placehold.it/150x50?text=Logo" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link smooth" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smooth" href="#productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smooth" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smooth" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="inicio">
        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/carousel_bg/bg-1.jpg" class="d-block w-100" alt="">
                </div>
                
                <div class="carousel-item">
                    <img src="assets/img/carousel_bg/bg-2.jpg" class="d-block w-100" alt="">
                </div>
                
                <div class="carousel-item">
                    <img src="assets/img/carousel_bg/bg-3.jpg" class="d-block w-100" alt="">
                </div>

                <div class="carousel-item">
                    <img src="assets/img/carousel_bg/bg-2.jpg" class="d-block w-100" alt="">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>

    <!-- Productos -->
    <div id="productos" class="container">
        <div class="row">
            <h1 class="title-section mx-auto">Productos</h1>
        </div>

        <div class="row">
            <?php 
                $a = new work();
                $a->products();
            ?>
        </div>

        <div class="row">
            <button type="button" class="btn btn-primary btn-lg mx-auto">Ver mas productos...</button>
        </div>

        <hr class="my-5">
    </div>

    <!-- Producto principal -->
    <div id="primary-product" class="container ">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1>Nombre autoclave</h1>
                <h4 class="text-muted">Informacion sobre el producto principal para que las personas sepan que es</h4>
                <ul>
                    <li>Caracteristica 1</li>
                    <li>Caracteristica 2</li>
                    <li>Caracteristica 3</li>
                    <li>Caracteristica 4</li>
                </ul>
            </div>
            <div class="col-md-5">
                <img class="img-primary-product" src="assets/img/productos/producto-primary.jpg" alt="">
            </div>
        </div>
        
        <hr class="my-5">
    </div>

    <!-- Servicios -->
    <div id="servicios" class="container">
        <div class="row">
            <h1 class="title-section mx-auto">Servicios</h1>
        </div>

        <div class="row">
            <?php 
                $a = new work();
                $a->services();
            ?>
        </div>

        <div class="row">
            <button type="button" class="btn btn-primary btn-lg mx-auto">Ver mas servicios...</button>
        </div>
    </div>

    <!-- Contacto -->
    <div id="contacto" class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118789.5126807108!2d-104.94694501530729!3d21.500971201301258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842735d8893dcfdb%3A0x83784645f40c2d79!2sTepic%2C%20Nay.!5e0!3m2!1ses-419!2smx!4v1588476483603!5m2!1ses-419!2smx" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>
    
            <div class="col-md-6 p-0">
                <form action="#">
                    <h2>Ponte en contacto.</h2>
                    <div class="form-group">
                        <label for="Name">Nombre: *</label>
                        <input type="text" class="form-control" requied="">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail: *</label>
                        <input type="email" class="form-control" requied="">
                    </div>
                    <div class="form-group">
                        <label for="number">Numero de Telefono:</label>
                        <input type="text" class="form-control" requied="">
                    </div>
                    <div class="form-group">
                        <label for="Message">Mensaje: *</label>
                        <textarea class="form-control" rows="5" requied=""></textarea>
                    </div>

                    <div class="form-group">
                        <p>* Campos requeridos</p>
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-3">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <p>© 2020 Nombre de la empresa.</p>
                <div>
                    <img src="http://placehold.it/150x50?text=Logo" alt="">
                </div> 
            </div>
        </div>
    </footer>
</body>
</html>