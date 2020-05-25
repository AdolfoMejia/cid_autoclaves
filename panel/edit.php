<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
            location.reload();
        });
    }, 4000);
</script>

<?php
require_once('./class/class.php');

if (isset($_POST['update'])) {
    $a = new work();
    $a->edit(
        $_POST["id"], 
        $_POST["type"], 
        $_POST["name"], 
        $_POST["short_description"], 
        $_POST["long_description"]
    );
    exit;
}

$id = $_GET['id'];
$type = $_GET['type'];

$statement = conexion::con()->query("SELECT * FROM $type WHERE id = $id");
$datos = $statement->fetch(PDO::FETCH_OBJ);

$name = $datos->name;
$short_description = $datos->short_description;
$long_description = $datos->long_description;
$image = $datos->image;

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
                <form id="add-form" action="edit.php" method="POST" enctype="multipart/form-data">
                    <h2>Editar</h2>
                    <div class="form-group">
                        <label for="Nombre">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Short description">Descripcion corta:</label>
                        <textarea name="short_description" class="form-control" rows="5" required><?php echo $short_description; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Long description">Descripcion larga:</label>
                        <textarea id="summernote" name="long_description" class="form-control" rows="5" required><?php echo $long_description; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Image">Imagen actual:</label>
                        <img src="../assets/img/<?php echo $type ?>/<?php echo $image ?>" width="150px" alt="<?php echo $image ?>">
                        <input type="file" name="archivo" id="archivo" class="ml-2">
                    </div>

                    <input type="hidden" name="update">
                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

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