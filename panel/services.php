<?php 
require_once('./class/class.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("./includes/head.php") ?>
</head>

<body>
    <?php include("./includes/nav.php") ?>

    <div class="container">
        <div id="page-content-wrapper">
            <div class="container mt-5">
                <div class="row">
                    <a
                        href="#"
                        class="btn btn-primary btn-lg mx-auto modal-open">
                        Agregar nuevo Servicio »
                    </a>
                </div>
                <div class="row mt-5">
                    <?php 
                        $a = new work();
                        $a->list("services");
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>