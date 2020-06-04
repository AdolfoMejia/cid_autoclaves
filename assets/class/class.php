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
            <div class="img-container mx-auto d-flex justify-content-center align-items-center">
                <img class="img-productos" src="assets/img/products/<?php echo $product->image ?>" alt="<?php echo $product->name ?>">
            </div>
            <h3><?php echo $product->name ?></h3>
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

    public function primary_product(){
        $statement = conexion::con()->query("SELECT * FROM primary_product");
        $primary = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($primary as $primary_product) {
        ?>

            <div class="col-md-7">
                <h1><?php echo $primary_product->title ?></h1>
                <?php echo $primary_product->description ?>
            </div>

            <div class="col-md-5">
                <img class="img-primary-product" src="assets/img/primary_product/<?php echo $primary_product->image ?>" alt="<?php echo $primary_product->title ?>">
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
            <div class="img-container mx-auto d-flex justify-content-center align-items-center">
                <img class="img-productos" src="assets/img/services/<?php echo $service->image ?>" alt="<?php echo $service->name ?>">
            </div>
            <h3><?php echo $service->name ?></h3>
            <p><?php echo $service->short_description ?></p>
            <button 
                type="button"
                class="btn btn-outline-primary modal-open"
                data-name="<?php echo $service->name ?>"
                data-type="services"
                data-modal-type="modalServices">
                Ver detalles »
            </button>
        </div>

        <?php
        }
    }

    public function sliders(){
        $statement = conexion::con()->query("SELECT * FROM sliders");
        $sliders = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($sliders as $slider) {
        ?>

        <div class="carousel-item">
            <div class="container">
                <div class="row no-gutters d-flex justify-content-center align-items-center">
                    <div class="carousel-caption col">
                        <h2><?php echo $slider->title ?></h2>
                        <?php echo $slider->description ?>
                    </div>

                    <div class="col-5 image-card" >
                        <img src="assets/img/sliders/<?php echo $slider->image ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <?php
        }
    }

    public function modal($name, $type){
        $statement = conexion::con()->query("SELECT * FROM $type WHERE name = '$name'");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
    ?>
        
        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <button type="button" class="close"><img src="./assets/img/close.png" alt="close"></button>

                        <div class="col-lg-5 image-card">
                            <img src="./assets/img/<?php echo $type ?>/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                        </div>

                        <div class="col-lg-7">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $data->name ?></h2>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <?php echo $data->long_description ?>

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

    public function modalServices($name, $type){
        $statement = conexion::con()->query("SELECT * FROM $type WHERE name = '$name'");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
    ?>

        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-3">
                    <div class="row">
                        <button type="button" class="close"><img src="./assets/img/close.png" alt="close"></button>

                        <div class="col">
                            <div class="card-body">
                                <div class="col image-card m-3">
                                    <img src="./assets/img/<?php echo $type ?>/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                                </div>

                                <h2 class="card-title"><?php echo $data->name ?></h2>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <?php echo $data->long_description ?>

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

    public function modalServicesAll($type){
        $statement = conexion::con()->query("SELECT * FROM $type");
        $data_bd = $statement->fetchAll(PDO::FETCH_OBJ);
    ?>

        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-5">
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <div class="col image-card">
                                    <img src="./assets/img/<?php echo $type ?>/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                                </div>

                                <h2 class="card-title"><?php echo $data->name ?></h2>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <?php echo $data->long_description ?>

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
        
        <div class="container">

            <?php
            foreach ($data_bd as $data) {
            ?>
            
                <div class="card mb-5">
                    <div class="row no-gutters">
                        <div class="col-lg-5 image-card">
                            <img src="./assets/img/<?php echo $type ?>/<?php echo $data->image ?>" alt="<?php echo $data->name ?>">
                        </div>

                        <div class="col-lg-7">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $data->name ?></h2>

                                <p class="card-text"><?php echo $data->short_description ?></p>
                                <?php echo $data->long_description ?>

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

    public function contactEmail($name, $email, $phone, $message){
                // multiple recipients (note the commas)
        $to = "itic_adolfo_mejia@hotmail.com";

        // subject
        $subject = "Contacto - AutoclavesCID";

        # Indicamos la dirección (nombre) del servidor
		$server_name = "autoclavescid.com";

        // compose message
        $message = "
        <html>
            <body>
                <h1>Estos son los datos del contacto</h1>
                <p>Nombre: $name</p>
                <p>Nombre: $email</p>
                <p>Nombre: $phone</p>
                <p>Nombre: $message</p>
            </body>
        </html>
        ";

        $header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=utf-8\r\n";
		$header .="From: contacto@$server_name\nReply-To:
		contacto@$server_name\nX-Mailer: PHP/";

        // send email
        if(mail($to, $subject, $message, $header)){
        ?>

        <div class="container" id="modalEmail">
            <div class="card mb-3">
                <div class="row">
                    <button type="button" class="close"><img src="./assets/img/close.png" alt="close"></button>

                    <div class="col">
                        <div class="card-body">
                            <div class="col image-card-email m-3">
                                <img src="./assets/img/ok.png" alt="successful">
                            </div>

                            <h2>Gracias por contactarnos!</h2>
                            <p class="lead">Revisaremos tu mensaje lo mas pronto posible y nos pondremos en contacto contigo.</p>
                            <p class="lead">Si tu problema no puede esperar puedes llamarnos al <strong>55-34-28-84-85</strong></p>
                            <p class="lead">Gracias.</p>

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-close-modal mx-auto">
                                Volver al sitio »
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
		}else{
        ?>

        <div class="container" id="modalEmail">
            <div class="card mb-3">
                <div class="row">
                    <button type="button" class="close"><img src="./assets/img/close.png" alt="close"></button>

                    <div class="col">
                        <div class="card-body">
                        <div class="col image-card-email m-3">
                                <img src="./assets/img/ok.png" alt="successful">
                            </div>

                            <h2>UPS! Tuvimos un error!</h2>
                            <p class="lead">Por favor intena de nuevo o llamanos al <strong>55-34-28-84-85</strong></p>
                            <p class="lead">Gracias.</p>

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-close-modal mx-auto">
                                Volver al sitio »
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
		}
    }
}
?>