<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
include 'responsive.php';
?>

    <?php if($mensaje == "1"){ ?>
        <div class="alert alert-success" style="font-family: Times; font-size: 22px">
            <?php echo "¡".openssl_decrypt($_POST['nombre'], COD, KEY)." agregado al carrito!";?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>
    <?php }else if($mensaje == "2"){?>
        
        <div class="alert alert-danger" style="font-family: Times; font-size: 22px">
            <?php echo "¡" . openssl_decrypt($_POST['nombre'], COD, KEY). " ya existe en el carrito!";?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>

    <?php } ?>

    <div class="row">

    <?php
    $sentencia = $pdo->prepare("SELECT * FROM `tblproductos`");
    $sentencia->execute();
    $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php foreach ($listaProductos as $producto) { 
        
        if($producto['Type'] == "App"){
            
        ?>

        <div class="col-sm-auto">
            <div class="card">
                <div id="packApps" class="carousel slide" data-ride="carousel" data-toggle="popover"
                data-trigger="hover"
                data-content="<?php echo $producto['Descripcion']; ?>">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="images/home.png" alt="Tools">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/login.png" alt="Login">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/shop.png" alt="Compraventa">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/usuarios.png" alt="Usuarios">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/puntuacion.png" alt="Puntajes">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/rompecabezas.png" alt="Rompecabezas">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="images/developer.png" alt="Developer">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#packApps" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#packApps" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body" style="font-family: Times; font-size: 25px; text-align: center;">
                    <span style="color: #1cb495"><?php echo $producto['Nombre']; ?></span>
                    <h5 class="card-title">$<?php echo $producto['Precio']; ?></h5>

                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY) ; ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY) ; ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY) ; ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY) ; ?>">
                        <button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar" 
                        style="font-family: Times; font-size: 20px;">
                        Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
            <br/>
        </div>
    
    <?php 
        }
    } 
    ?>

    <script>

        $('.carousel').carousel({
            interval: 2000
        });

        $(function () {
            $('[data-toggle="popover"]').popover()
        });
    
    </script>

    <?php include 'templates/pie.php'; ?>