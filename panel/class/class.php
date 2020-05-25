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
                        <img src="../assets/img/<?php echo $type ?>/<?php echo $product->image ?>" alt="<?php echo $product->name ?>">
                    </div>

                    <div class="col-lg-7">
                        <div class="card-body">
                            <h1 class="card-title"><?php echo $product->name ?></h1>

                            <p class="card-text"><?php echo $product->short_description ?></p>
                            <?php echo $product->long_description ?>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center p-3">
                    <a
                        href="edit.php?id=<?php echo $product->id ?>&type=<?php echo $type ?>"
                        class="btn btn-lg btn-info">
                        Editar »
                    </a>

                    <a
                        href="<?php echo $type ?>.php"
                        class="btn btn-lg btn-outline-danger ml-3 delete"
                        data-id="<?php echo $product->id ?>"
                        data-type="<?php echo $type ?>"
                        data-modal-type="delete">
                        Eliminar »
                    </a>
                </div>
            </div>
            
        <?php
        }
    }

    public function list_sliders($type){
        $statement = conexion::con()->query("SELECT * FROM $type");
        $products = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($products as $product) {
        ?>

            <div class="card mb-5">
                <div class="row no-gutters">
                    <div class="col-lg-7">
                        <div class="card-body">
                            <h1><?php echo $product->title ?></h1>
                            <?php echo $product->description ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 image-card">
                        <img src="../assets/img/<?php echo $type ?>/<?php echo $product->image ?>" alt="<?php echo $product->image ?>">
                    </div>
                </div>

                <div class="row justify-content-center p-3">
                    <a
                        href="edit-slider.php?id=<?php echo $product->id ?>&type=<?php echo $type ?>"
                        class="btn btn-lg btn-info">
                        Editar »
                    </a>

                    <a
                        href="<?php echo $type ?>.php"
                        class="btn btn-lg btn-outline-danger ml-3 delete"
                        data-id="<?php echo $product->id ?>"
                        data-type="sliders"
                        data-modal-type="delete">
                        Eliminar »
                    </a>
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
                if (move_uploaded_file($temp, '../assets/img/'.$type.'/'.$archivo)) {

                    if($type == "products"){
                        $data = [
                            'name' => $name,
                            'short_description' => $short,
                            'long_description' => $long,
                            'image' => $archivo,
                            'feature_product' => '0',
                        ];

                        $sql = "INSERT INTO `$type` (`name`, `short_description`, `long_description`, `image`, `feature_product`) VALUES (:name, :short_description, :long_description, :image, :feature_product)";
                    }

                    if($type == "services"){
                        $data = [
                            'name' => $name,
                            'short_description' => $short,
                            'long_description' => $long,
                            'image' => $archivo,
                        ];

                        $sql = "INSERT INTO `$type` (`name`, `short_description`, `long_description`, `image`) VALUES (:name, :short_description, :long_description, :image)";
                    }

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

    public function add_slider($type, $title, $description){
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
                if (move_uploaded_file($temp, '../assets/img/'.$type.'/'.$archivo)) {
                    $data = [
                        'title' => $title,
                        'description' => $description,
                        'image' => $archivo,
                    ];

                    $sql = "INSERT INTO `$type` (`title`, `description`, `image`) VALUES (:title, :description, :image)";
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

    public function edit($id, $type, $name, $short, $long){
        $archivo = $_FILES['archivo']['name'];

        if (isset($archivo) && $archivo != "") {
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];

            if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 200000000)) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .jpg y .png</b></div>';
            } else {
                if (move_uploaded_file($temp, '../assets/img/'.$type.'/'.$archivo)) {
                    $sentencia = conexion::con()->prepare("UPDATE $type SET name = ?, short_description = ?, long_description = ?, image = ? WHERE id = ?");
                    $resultado = $sentencia->execute([$name, $short, $long, $archivo, $id]);
                    
                    if($resultado === TRUE) {
                    ?>

                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Todo salio bien!</strong> Se guardo toda la informacion enviada
                        </div>

                    <?php 
                    } else {
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
        } else {
            $sentencia = conexion::con()->prepare("UPDATE $type SET name = ?, short_description = ?, long_description = ? WHERE id = ?");
            $resultado = $sentencia->execute([$name, $short, $long, $id]);
            
            if($resultado === TRUE) {
            ?>

                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Todo salio bien!</strong> Se guardo toda la informacion enviada
                </div>

            <?php 
            } else {
            ?>

                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Algo salio mal!</strong> No se guardo la informacion en la Base de datos
                </div>

            <?php
            }
        }
    }

    public function edit_slider($id, $type, $title, $description){
        $archivo = $_FILES['archivo']['name'];

        if (isset($archivo) && $archivo != "") {
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];

            if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 200000000)) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .jpg y .png</b></div>';
            } else {
                if (move_uploaded_file($temp, '../assets/img/'.$type.'/'.$archivo)) {
                    $sentencia = conexion::con()->prepare("UPDATE $type SET title = ?, description = ?, image = ? WHERE id = ?");
                    $resultado = $sentencia->execute([$title, $description, $archivo, $id]);
                    
                    if($resultado === TRUE) {
                    ?>

                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Todo salio bien!</strong> Se guardo toda la informacion enviada
                        </div>

                    <?php 
                    } else {
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
        } else {
            $sentencia = conexion::con()->prepare("UPDATE $type SET title = ?, description = ? WHERE id = ?");
            $resultado = $sentencia->execute([$title, $description, $id]);
            
            if($resultado === TRUE) {
            ?>

                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Todo salio bien!</strong> Se guardo toda la informacion enviada
                </div>

            <?php 
            } else {
            ?>

                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Algo salio mal!</strong> No se guardo la informacion en la Base de datos
                </div>

            <?php
            }
        }
    }

    public function delete($id, $type){
        $sentencia = conexion::con()->prepare("DELETE FROM $type WHERE id = ?");
        $resultado = $sentencia->execute([$id]);
        
        if($resultado === TRUE) {
        ?>

            <div id="inner-message"  class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Todo salio bien!</strong> Se ha borrado de la Base de datos
            </div>

        <?php 
        } else {
        ?>

            <div id="inner-message"  class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Algo salio mal!</strong> No se pudo borrar de la Base de datos
            </div>

        <?php
        }
    }
}
?>