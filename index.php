<script>
    $('button.close, button.btn-close-modal').click(function(){
        $('body').removeClass('overflow');
        $("#modal").fadeOut("fast");
    });
</script>

<?php 
require_once('./assets/class/class.php');

if (isset($_POST["action"]) and $_POST["action"] == 'modal')
{
    $t = new work();
    $t -> modal($_POST["name"], $_POST["type"]);
    exit;
}else{}

if (isset($_POST["action"]) and $_POST["action"] == 'modalServices')
{
    $t = new work();
    $t -> modalServices($_POST["name"], $_POST["type"]);
    exit;
}else{}

if (isset($_POST["action"]) and $_POST["action"] == 'modalServicesAll')
{
    $t = new work();
    $t -> modalServicesAll($_POST["type"]);
    exit;
}else{}

if (isset($_POST["action"]) and $_POST["action"] == 'modal-all')
{
    $t = new work();
    $t -> modalAll($_POST["type"]);
    exit;
}else{}

if (isset($_POST["action"]) and $_POST["action"] == 'contactEmail')
{
    $t = new work();
    $t -> contactEmail($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["message"]);
    exit;
}else{}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoclaves de Mexico</title>

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

    <!-- Banner contact -->
    <div class="fixed-top text-center contact-banner">
        <div class="container">
            <p>Contactanos al numero <strong>55-34-28-84-85</strong></p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mt-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img id="logo" src="./assets/img/logo.png" alt="cid autoclaves">
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
    
    <!-- Carousel -->
    <div id="inicio">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                    $a = new work();
                    $a->sliders();
                ?>
            </div>

            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
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
            <button
                type="button"
                class="btn btn-primary btn-lg mx-auto modal-open"
                data-type="products"
                data-modal-type="modal-all">
                Ver mas productos...
            </button>
        </div>

        <hr class="my-5">
    </div>

    <!-- Producto principal -->
    <div id="primary-product" class="container ">
        <div class="row align-items-center">
            <?php 
                $a = new work();
                $a->primary_product();
            ?>
        </div>
        
        <hr class="my-5">
    </div>

    <!-- Servicios -->
    <div id="servicios" class="container">
        <div class="row">
            <h1 class="title-section mx-auto">Servicios</h1>
        </div>

        <div class="row justify-content-center">
            <?php 
                $a = new work();
                $a->services();
            ?>
        </div>

        <div class="row">
            <button
                type="button"
                class="btn btn-primary btn-lg mx-auto modal-open"
                data-type="services"
                data-modal-type="modalServicesAll">
                Ver mas servicios...
            </button>
        </div>
    </div>

    <!-- Contacto -->
    <div id="contacto" class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118789.5126807108!2d-104.94694501530729!3d21.500971201301258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842735d8893dcfdb%3A0x83784645f40c2d79!2sTepic%2C%20Nay.!5e0!3m2!1ses-419!2smx!4v1588476483603!5m2!1ses-419!2smx" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>
    
            <div class="col-md-6 p-0">
                <form id="contact" method="post">
                    <h2>Ponte en contacto.</h2>
                    <div class="form-group">
                        <label for="Name">Nombre: *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail: *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Numero de Telefono:</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="Message">Mensaje: *</label>
                        <textarea class="form-control" rows="5" name="message" required></textarea>
                    </div>

                    <div class="form-group">
                        <p>* Campos requeridos</p>
                    </div>

                    <input type="hidden" name="action" value="contactEmail">
    
                    <input type="submit" class="btn btn-primary mt-3" value="Enviar Mensaje"/>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <p>© 2020 Nombre de la empresa.</p>
                <div>
                    <img src="./assets/img/logo.png" alt="cid autoclaves">
                </div> 
            </div>
        </div>
    </footer>
</body>
</html>