<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
?>

<?php 

if($_POST){

    $IDVENTA = openssl_decrypt($_POST['IDVENTA'],COD,KEY);
    $IDPRODUCTO = openssl_decrypt($_POST['IDPRODUCTO'],COD,KEY);

    $sentencia = $pdo->prepare("SELECT * FROM tbldetalleventa 
    WHERE IDVENTA = :IDVENTA 
    AND IDPRODUCTO = :IDPRODUCTO
    AND DESCARGADO < " . DESCARGAS);

    $sentencia->bindParam(':IDVENTA', $IDVENTA);
    $sentencia->bindParam(':IDPRODUCTO', $IDPRODUCTO);
    $sentencia->execute();

    $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    if($sentencia->rowCount() > 0){

        $nombreArchivo = "archivos/".$listaProductos[0]['IDPRODUCTO'].".rar";
        $nuevoNombre = openssl_decrypt($_POST['Nombre'],COD,KEY).".rar";

        header("Content-Transfer-Encoding: binary");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=$nuevoNombre");
        readfile("$nombreArchivo");

        $sentencia = $pdo->prepare("UPDATE `tbldetalleventa` SET descargado = descargado + 1 
        WHERE IDVENTA = :IDVENTA 
        AND IDPRODUCTO = :IDPRODUCTO");

        $sentencia->bindParam(':IDVENTA', $IDVENTA);
        $sentencia->bindParam(':IDPRODUCTO', $IDPRODUCTO);
        $sentencia->execute();

    }else{
        include 'templates/cabecera.php';

        echo "<h2 style='font-family: Times New Roman; color: #1cb495; font-size: 30px; text-align: center;'>Descargas agotadas</h2>";

        include 'templates/pie.php';
    }
}
?>