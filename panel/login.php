<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);
</script>

<?php
require_once('./class/class.php');

if (isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

if (isset($_POST['login'])) {
    $a = new work();
    $a->login($_POST["user"], $_POST["password"]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/head.php") ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <div class="card rounded shadow shadow-sm">
                            <div class="card-header">
                                <h2 class="mb-0">Iniciar sesion</h2>
                            </div>

                            <div class="card-body">
                                <form class="form" action="login.php" role="form" id="login-form" method="POST">
                                    <div class="form-group">
                                        <label for="user">Usuario:</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="user" id="user" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Contraseña:</label>
                                        <input type="password" class="form-control form-control-lg rounded-0" name="password" id="password" required>
                                    </div>

                                    <input type="hidden" name="login">

                                    <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div id="responser" class="col-lg-6 col-md-8 mx-auto"></div>
        </div>
    </div>
</body>
</html>