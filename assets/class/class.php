
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
                class="btn btn-outline-primary productos"
                data-name="<?php echo $product->name ?>"
                data-type="productos"
                data-toggle="modal"
                data-target="#exampleModalLong">
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
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalLong">Ver detalles »</button>
        </div>

        <?php
        }
    }

    public function modal(){
        ?>

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLongTitle">Nombre del producto</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img class="img-productos" src="assets/img/productos/autoclave.jpg" alt="">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
    }
}
?>