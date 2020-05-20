
<?php
class conexion {
    public static function con(){
        $password = "";
        $user = "root";
        $databaseName = "cid_autoclaves";
        try{
            $con = new PDO('mysql:host=localhost;dbname=' . $databaseName, $user, $password);
            return $con;
        }catch(Exception $e){
            echo "Error connecting to db: " . $e->getMessage();
        }
	}
}

class work {
	public function list($type){
        $statement = conexion::con()->query("SELECT * FROM $type");
        $products = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($products as $product) {
        ?>

            <div class="card mb-5">
                <div class="row no-gutters">
                    <div class="col-lg-5 image-card">
                        <img src="../assets/img/productos/<?php echo $product->image ?>" alt="<?php echo $product->name ?>">
                    </div>

                    <div class="col-lg-7">
                        <div class="card-body">
                            <h1 class="card-title"><?php echo $product->name ?></h1>

                            <p class="card-text"><?php echo $product->short_description ?></p>
                            <p class="card-text"><?php echo $product->long_description ?></p>

                            <a
                                href="<?php echo $product->id ?>"
                                class="btn btn-outline-primary">
                                Editar »
                            </a>

                            <a
                                href="<?php echo $product->id ?>"
                                class="btn btn-outline-danger ml-3">
                                Eliminar »
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
        }
    }

    public function add($type, $name, $short, $long){
        $archivo = $_FILES['archivo']['name'];

        if (isset($archivo) && $archivo != "") {
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];

            if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 200000000)) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .jpg y .png</b></div>';
            }
            else {
                if (move_uploaded_file($temp, '../assets/img/productos/'.$archivo)) {

                    $data = [
                        'name' => $name,
                        'short_description' => $short,
                        'long_description' => $long,
                        'image' => $archivo,
                        'feature_product' => '0',
                    ];

                    $sql = "INSERT INTO `$type` (`name`, `short_description`, `long_description`, `image`, `feature_product`) VALUES (:name, :short_description, :long_description, :image, :feature_product)";
                    $stmt= conexion::con()->prepare($sql);

                    if($stmt->execute($data)){
                        ?>

                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Todo salio bien!</strong> Se guardo toda la informacion enviada
                            </div>

                        <?php 
                    }else {
                    ?>

                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Algo salio mal!</strong> No se guardo la informacion en la Base de datos
                        </div>

                    <?php
                    }
                }
                else {
                ?>

                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Algo salio mal!</strong> Ocurrió algún error al subir la imagen o guardar en la Base de datos
                    </div>
                
                <?php
                }
            }
        }
    }
}
?>