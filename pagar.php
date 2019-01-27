<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php 

if($_POST){

    $total = 0;
    $SID = session_id();
    $Correo = $_POST['email'];

    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $sentencia = $pdo->prepare("INSERT INTO `tblVentas`
    (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `Status`) 
    VALUES (NULL, :ClaveTransaccion, ' ', NOW(), :Correo, :Total, 'Pendiente');");

    $sentencia->bindParam(":ClaveTransaccion" , $SID);
    $sentencia->bindParam(":Correo" , $Correo);
    $sentencia->bindParam(":Total" , $total);
    $sentencia->execute();
    $idVenta = $pdo->lastInsertId();

    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $sentencia = $pdo->prepare("INSERT INTO `tbldetalleventa` 
        (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");

        $sentencia->bindParam(":IDVENTA" , $idVenta);
        $sentencia->bindParam(":IDPRODUCTO" , $producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO" , $producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD" , $producto['CANTIDAD']);
        $sentencia->execute();
    }
}
?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }

    h1{
        font-size: 45px;
        font-family: "Times New Roman";
        color: #1cb495;
    }

</style>

<div class="jumbotron text-center" style="font-family: Times New Roman; font-size: 25px;">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estás a punto de pagar con PayPal la cantidad de
        <h4>$<?php echo number_format($total, 2) ?> </h4>
        <div id="paypal-button-container"></div>
    </p>
    
    <p>Los productos podrán ser descargados una vez se procese el pago<br/>
    <strong>(Para aclaraciones → zanti4020@gmail.com)</strong>
    </p>
</div>

<script>

    paypal.Button.render({
        
        // Set your environment

        env: 'production', // sandbox | production

        // Specify the style of the button

        style: {
            label: 'pay',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    'Af_zFuVd2QLuIZlolQn91bIVugQ4L0MfE0Zb-zRQGglWrou70Imrfh2E8AOQ0M5MtLr1xLt5f6SPoluK',
            production: 'ASuv78iK7bkReEHah5sbhQunwTRQZDgRxv0tFU_3fg9VIvchDdq_TigJzTAwK8Ok6LJyYeksb8mnwzMt'
        },

        // Wait for the PayPal button to be clicked

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total; ?>', currency: 'USD' },
                            description: "Compra de productos a My Systems: $<?php echo number_format($total, 2); ?>",
                            custom: "<?php echo $SID; ?>#<?php echo openssl_encrypt($idVenta, COD, KEY); ?>"
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                //console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    
    }, '#paypal-button-container');

</script>

<?php include 'templates/pie.php'; ?>