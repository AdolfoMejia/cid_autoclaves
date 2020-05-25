<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);
</script>

<?php
require_once('./class/class.php');

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

if (isset($_POST['add'])) {
    $a = new work();
    $a->add($_POST["type"], $_POST["name"], $_POST["short_description"], $_POST["long_description"]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("./includes/head.php") ?>
</head>

<body>
    <?php include("./includes/nav.php") ?>
    
    <div id="add" class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="add-form" action="add-service.php" method="POST" enctype="multipart/form-data">
                    <h2>Agregar servicio</h2>
                    <div class="form-group">
                        <label for="Nombre">Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Short description">Descripcion corta:</label>
                        <textarea name="short_description" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Long description">Descripcion larga:</label>
                        <textarea id="summernote" name="long_description" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Image">Imagen:</label>
                        <input type="file" name="archivo" id="archivo" class="ml-2" required>
                    </div>

                    <input type="hidden" name="add">
                    <input type="hidden" name="type" value="services">

                    <input type="submit" class="btn btn-success btn-lg submitBtn" value="Guardar"/>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div id="responser" class="col-md-12 mt-3"></div>
        </div>
    </div>
</body>
</html>