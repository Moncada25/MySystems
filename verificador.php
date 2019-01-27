<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
include 'responsive.php';

$Login = curl_init(LINKAPI."/v1/oauth2/token");

curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($Login, CURLOPT_USERPWD, CLIENTID.":".SECRET);
curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$Respuesta = curl_exec($Login);

$objRespuesta = json_decode($Respuesta);

$AccessToken = $objRespuesta->access_token;

$venta = curl_init(LINKAPI."/v1/payments/payment/".$_GET['paymentID']);

curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ".$AccessToken));
curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

$RespuestaVenta = curl_exec($venta);

$objDatosTransaccion = json_decode($RespuestaVenta);

$state = $objDatosTransaccion->state;
$email = $objDatosTransaccion->payer->payer_info->email;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$currency = $objDatosTransaccion->transactions[0]->amount->currency;
$custom = $objDatosTransaccion->transactions[0]->custom;

$clave = explode("#", $custom);

$SID = $clave[0];
$claveVenta = openssl_decrypt($clave[1], COD, KEY);

curl_close($venta);
curl_close($Login);

if($state == "approved"){

    $mensajePaypal = "<h3>Pago procesado exitosamente</h3>";

    $sentencia = $pdo->prepare("UPDATE `tblventas` 
    SET `PaypalDatos` = :PaypalDatos, `Status` = 'Aprobado' 
    WHERE `tblventas`.`ID` = :ID;");

    $sentencia->bindParam(":ID", $claveVenta);
    $sentencia->bindParam(":PaypalDatos", $RespuestaVenta);
    $sentencia->execute();

    $sentencia = $pdo->prepare("UPDATE `tblventas`SET `Status` = 'Completo' 
    WHERE `ClaveTransaccion` = :ClaveTransaccion
    AND Total = :TOTAL
    AND ID = :ID;");

    $sentencia->bindParam(":ClaveTransaccion", $SID);
    $sentencia->bindParam(":TOTAL", $total);
    $sentencia->bindParam(":ID", $claveVenta);
    $sentencia->execute();

    $completado = $sentencia->rowCount();
    
    session_destroy();

}else{
    $mensajePaypal = "<h3>Hubo un problema con el pago de PayPal</h3>";
}

?>

<style>
    h1{
        font-size: 45px;
        font-family: Times New Roman;
        color: #1cb495;
    }
</style>

<div class="jumbotron text-center" style="font-family: Times New Roman; font-size: 25px;">
    <h1 class="display-4">¡Listo!</h1>
    <hr class="my-4">
    <p class="lead"><?php echo $mensajePaypal; ?></p>
    
    <p>
    <?php

    if($completado >= 1){

        $sentencia = $pdo->prepare("SELECT * FROM tblproductos, tbldetalleventa 
        WHERE tbldetalleventa.IDPRODUCTO = tblproductos.ID 
        AND tbldetalleventa.IDVENTA = :ID");

        $sentencia->bindParam(':ID', $claveVenta);
        $sentencia->execute();
        
        $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    ?>
    <div class="row">
        <?php foreach($listaProductos as $producto){ ?>
        <div class="col-sm-auto">
            <div class="card">
                <img
                class="card-img-top" 
                src="<?php echo $producto['Imagen']; ?>"
                height="450px">
                <div class="card-body" style="font-family: Times New Roman; font-size: 20px; text-align: center;">
                    
                    <p style="color: #1cb495" class="card-text"><?php echo $producto['Nombre']; ?></p>

                    <?php if($producto['DESCARGADO'] < DESCARGAS){ ?>

                    <form action="descargas.php" method="post">
                        <input type="hidden" name="IDVENTA" id="" value="<?php echo openssl_encrypt($claveVenta, COD, KEY); ?>">
                        <input type="hidden" name="IDPRODUCTO" id="" value="<?php echo openssl_encrypt($producto['IDPRODUCTO'], COD, KEY); ?>">
                        <input type="hidden" name="Nombre" id="" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
                        <button class="btn btn-success" type="submit">Download</button>
                    </form>

                    <?php }else{ ?>
                        <button class="btn btn-success" type="button" disabled>Download</button>
                    <?php } ?>
                </div>
            </div>
            <br/>
        </div>
        <?php } ?>
    </div>
    
    </p>
</div>

<?php include 'templates/pie.php'; ?>