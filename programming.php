<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
include 'responsive.php';
?>

<div class="row">

    <?php
    $sentencia = $pdo->prepare("SELECT * FROM `tblproductos`");
    $sentencia->execute();
    $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //print_r($listaProductos);
    ?>

    <?php foreach ($listaProductos as $producto) { 
        
        if($producto['Type'] == "BookP"){

        ?>

        <div class="col-sm-auto">
            <div class="card">
                <img
                title="<?php echo $producto['Nombre']; ?>"
                alt="<?php echo $producto['Nombre']; ?>" 
                class="card-img-top" 
                src="<?php echo $producto['Imagen']; ?>"
                data-toggle="popover"
                data-trigger="hover"
                data-content="<?php echo $producto['Descripcion']; ?>"
                height="450px"
                >
                <div class="card-body" style="font-family: Times New Roman; font-size: 25px; text-align: center;">
                    <span style="color: #1cb495"><?php echo $producto['Nombre']; ?></span>
                    <h5 class="card-title">Free</h5>

                    <button class="btn btn-primary" type="button" name="btnAccion" value="Ver" href="#" 
                    onclick="window.open('archivosPDF/<?php echo $producto['ID']; ?>.pdf', '_blank'); return false;" 
                    style="font-family: Times New Roman; font-size: 20px;">
                    View
                    </button>      
                    
                </div>
             </div>
             <br/>
        </div>
    
    <?php     
        } 
    }
?>

<script>

    $(function () {
        $('[data-toggle="popover"]').popover()
    })

</script>

<?php include 'templates/pie.php'; ?>