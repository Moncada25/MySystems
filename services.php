<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<style>

    .btn{
        background-color: #1cb495;
        color: white;
    }

    h1{
        font-size: 45px;
        font-family: "Times New Roman";
        color: #1cb495;
    }

    .img-fluid{
        border-radius: 15px;
    }

    h2{
        font-size: 30px;
        font-family: "Times New Roman";
        color: #1cb495;
        margin-bottom: 18px;
        margin-top: 18px;
    }

</style>

 <div class="jumbotron text-center">
    <form action="solicitar_servicio.php" method="post">
        <h1 class="display-4">Servicios</h1>
        <button class="btn" type="submit">¡Solicita tu servicio!</button>
        <hr class="my-4">
    </form> 

    <h2>Desarrollador</h2>
    <img class="img-fluid" src="images/desarrollador.png">
    <hr class="my-4">
    <h2>Soporte Técnico</h2>
    <img class="img-fluid" src="images/soporte.jpg">
</div>

<?php include 'templates/pie.php'; ?>