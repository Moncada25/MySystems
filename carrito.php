<?php

session_start();

$mensaje = "";

if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {

        case "Agregar":

            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                //$mensaje .= "Ok ID correcto ".$ID."</br>";
            } else {
                //$mensaje .= "Upss... ID incorrecto ".$ID."</br>";
            }

            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                //$mensaje .= "Ok Nombre correcto ".$NOMBRE."</br>";
            } else {
                //$mensaje .= "Upss... Nombre incorrecto ".$NOMBRE."</br>";
            }

            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                //$mensaje .= "Ok Precio correcto ".$PRECIO."</br>";
            } else {
                //$mensaje .= "Upss... Precio incorrecto ".$PRECIO."</br>";
            }

            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                //$mensaje .= "Ok Cantidad correcto ".$CANTIDAD."</br>";
            } else {
                //$mensaje .= "Upss... Cantidad incorrecto ".$CANTIDAD."</br>";
            }

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
            } else {

                $idProductos = array_column($_SESSION['CARRITO'], "ID");

                if (in_array($ID, $idProductos)) {
                    //echo "<script>alert('El producto ya ha sido agregado al carrito...');</script>";
                    $mensaje = "2";
                } else {

                    $NumeroProductos = count($_SESSION['CARRITO']);

                    $producto = array(
                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' => $CANTIDAD,
                        'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][$NumeroProductos] = $producto;

                    //$mensaje = print_r($_SESSION, true);
                    $mensaje = "1";
                }
            }

            break;

        case "Eliminar":

            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);

                foreach ($_SESSION['CARRITO'] as $indice => $producto) {

                    if ($producto['ID'] == $ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                        $mensaje = $producto['NOMBRE'] . " eliminado del carrito";
                        //echo "<script>alert('Elemento eliminado...')</script>";
                    }
                }
            } else {
                $mensaje .= "Upss... ID incorrecto " . $ID . "</br>";
            }

            break;
    }
}

 