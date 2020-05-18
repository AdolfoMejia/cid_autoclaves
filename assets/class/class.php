
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
	public function products(){
        $statement = conexion::con()->query("SELECT * FROM products WHERE feature_product = 0 ORDER BY RAND() LIMIT 3");
        $products = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($products as $product) {
        ?>

        <div class="col-lg-4 mb-5">
            <img class="img-productos" src="assets/img/productos/<?php echo $product->image ?>" alt="<?php echo $product->name ?>">
            <h2><?php echo $product->name ?></h2>
            <p><?php echo $product->short_description ?></p>
            <button 
                type="button"
                class="btn btn-outline-primary modal-open"
                data-name="<?php echo $product->name ?>"
                data-type="products"
                data-modal-type="modal">
                Ver detalles »
            </button>
        </div>

        <?php
        }
    }

    public function services(){
        $statement = conexion::con()->query("SELECT * FROM services ORDER BY RAND() LIMIT 3");
        $services = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($services as $service) {
        ?>

        <div class="col-lg-4 mb-5">
            <h2><?php echo $service->name ?></h2>
            <p><?php echo $service->short_description ?></p>
            <button 
                type="button"
                class="btn btn-outline-primary modal-open"
                data-name="<?php echo $service->name ?>"
                data-type="services"
                data-modal-type="modal">
                Ver detalles »
            </button>
        </div>

        <?php
        }
    }

    public function modal($name, $type){
        $statement = conexion::con()->query("SELECT * FROM $type WHERE name = '$name'");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
    ?>

        <script>
            $('button.close, button.btn-close-modal').click(function(){
                $('body').removeClass('overflow');
                $("#modal").fadeOut("fast");
            });
        </script>
        
        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <button type="button" class="close"><img src="./assets/img/close.png" alt="close"></button>

                        <div class="col-lg-5 image-card">
                            <img src="./assets/img/productos/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                        </div>

                        <div class="col-lg-7">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo $data->name ?></h1>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <p class="card-text"><?php echo $data->long_description ?></p>

                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-close-modal mx-auto">
                                    Volver al sitio »
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php 
            }
            ?>

        </div>
    <?php
    }

    public function modalAll($type){
        $statement = conexion::con()->query("SELECT * FROM $type");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
    ?>

        <script>
            $('button.close, button.btn-close-modal').click(function(){
                $('body').removeClass('overflow');
                $("#modal").fadeOut("fast");
            });
        </script>
        
        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-5">
                    <div class="row no-gutters">
                        <div class="col-lg-5 image-card">
                            <img src="./assets/img/productos/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                        </div>

                        <div class="col-lg-7">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo $data->name ?></h1>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <p class="card-text"><?php echo $data->long_description ?></p>

                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-close-modal mx-auto">
                                    Volver al sitio »
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php 
            }
            ?>

        </div>
    <?php
    }
}
?>