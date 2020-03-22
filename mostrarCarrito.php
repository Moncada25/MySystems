<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<link rel="stylesheet" href="css/text.css">

<style>
    .titulos {
        font-size: 30px;
        font-family: "Times New Roman";
        color: #1cb495
    }

    h1 {
        font-size: 45px;
        font-family: "Times New Roman";
        color: #1cb495;
    }

    .productos {
        font-family: "Times New Roman";
        font-size: 25px
    }

    .form-group {
        text-align: center;
        font-family: "Times New Roman";
        font-size: 25px
    }

    small {
        text-align: center;
        font-family: "Times New Roman";
        font-size: 18px
    }

    input[type=text] {
        width: 100%;
        height: auto;
        border-top: none;
    }

    form .form-row input[type="text"]:focus+label[data-placeholder]:after,
    form .form-row input[type="text"]:valid+label[data-placeholder]:after,
    form .form-row input[type="text"]+label[data-placeholder]:after {
        color: #1cb495;
    }

    form .form-row input[type="text"]+label[data-placeholder]:after {
        top: 60%;
        font-size: 22px;
    }

    form .form-row input[type="text"]:focus,
    form .form-row input[type="text"]:valid,
    form .form-row input[type="text"] {
        border: 2px solid #1cb495;
        color: black;
        border-top: none;
        margin-top: 15px;
        margin-bottom: 0px;
        font-size: 20px;
    }
</style>

<br />
<?php if ($mensaje != "" && count($_SESSION['CARRITO']) >= 1) { ?>
<div class="alert alert-danger efecto-abajo">
    <?php echo $mensaje; ?>
</div>
<?php 
} ?>

<?php if (!empty($_SESSION['CARRITO'])) { ?>

<header id="header" class="efecto-abajo">
    <h1>Lista de Compras</h1>
</header>

<table class="table table-dark table-striped efecto-abajo">
    <tbody>
        <tr>
            <th width="40%" class="titulos">Producto</th>
            <th width="15%" class="titulos">Unidades</th>
            <th width="20%" class="titulos">Precio</th>
            <th width="20%" class="titulos">Total</th>
            <th width="5%"><img class="img-fluid" src="images/icon/eliminar.png"></th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>

        <tr>
            <td class="productos"><?php echo $producto['NOMBRE']; ?></td>
            <td class="productos"><?php echo $producto['CANTIDAD']; ?></td>
            <td class="productos"><?php echo "$" . $producto['PRECIO']; ?></td>
            <td class="productos"><?php echo "$" . number_format($producto['PRECIO'] * $producto['CANTIDAD'], 2); ?></td>
            <td>
                <form action="" method="post">

                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);
                                                                    ?>">

                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
        <?php 
    } ?>
        <tr>
            <td colspan="3">
                <h3 style="font-family: Times New Roman; font-size: 30px; color: #1cb495">Total</h3>
            </td>
            <td>
                <h3 style="font-family: Times New Roman; font-size: 30px">$<?php echo number_format($total, 2); ?></h3>
            </td>
            <td></td>
        </tr>

        <tr>
            <td colspan="5">

                <form action="pagar.php" method="post">
                    <div class="alert alert-success">
                        <div class="form-group">
                            <div class="form-row">
                                <input maxlength="30" minlength="1" id="email" type="text" name="email" required />
                                <label alt="Label" data-placeholder="Correo de contacto"></label>
                            </div>
                        </div>

                        <small id="emailHelp" class="form-text text-muted">
                            Los productos serán enviados a este correo
                        </small>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">
                        Proceder a pagar
                    </button>

                </form>

            </td>
        </tr>

    </tbody>
</table>
<?php 
} else { ?>
<div class="alert alert-success productos efecto-abajo">
    No hay productos en el carrito, ¡anímate y compra algo!
    <a href="index.php" class="badge badge-success">¡Quiero comprar!</a>
</div>
<?php 
} ?>

<?php include 'templates/pie.php'; ?> 