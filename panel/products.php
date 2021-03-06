<?php
require_once('./class/class.php');
?>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
            location.reload();
        });
    }, 4000);
</script>

<?php
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

if (isset($_POST['action']) && $_POST['action'] == "delete") {
    $a = new work();
    $a->delete(
        $_POST["id"], 
        $_POST["type"]
    );
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

    <div class="container">
        <div id="page-content-wrapper">
            <div class="container mt-5">
                <div class="row">
                    <a
                        href="add-product.php"
                        class="btn btn-success btn-lg mx-auto modal-open">
                        Agregar nuevo Producto »
                    </a>
                </div>
                <div class="row mt-5">
                    <?php 
                        $a = new work();
                        $a->list("products");
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="messageAlert">
    </div>
</body>
</html>