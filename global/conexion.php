<?php

try {

    $pdo = new PDO(
        'mysql:host=' . SERVIDOR . '; dbname=' . BD . '',
        USUARIO,
        PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );

    //echo "<script>alert('Conectado...')</script>";
} catch (PDOException $e) {
    //echo "<script>alert('Error al conectar...')</script>";
}
 