
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
            <img class="img-productos" src="assets/img/productos/<?php echo $product->image ?>" alt="">
            <h2><?php echo $product->name ?></h2>
            <p><?php echo $product->short_description ?></p>
            <button 
                type="button"
                class="btn btn-outline-primary modal-open"
                data-name="<?php echo $product->name ?>"
                data-type="products"
                data-toggle="modal" data-target="#exampleModalLong">
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
                data-type="services">
                Ver detalles »
            </button>
        </div>

        <?php
        }
    }

    public function modal($name, $type){
        $statement = conexion::con()->query("SELECT * FROM $type WHERE name = '$name'");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($data_bd as $data) {
        ?>
        <script>
            $('button.close').click(function(){
                $('body').removeClass('overflow');
                $("#modal").fadeOut("fast");
            });
        </script>

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><?php echo $data->name ?></h2>
                    <button type="button" class="close">X
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-productos" src="assets/img/productos/autoclave.jpg" alt="">
                    <p><?php echo $data->long_description ?></p>
                </div>
            </div>
        </div>

        <?php
        }
    }
}
?>