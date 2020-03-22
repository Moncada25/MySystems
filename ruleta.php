<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<link rel="stylesheet" href="css/text.css">

<style>
    /*Body*/
    body,
    html {
        background: url("images/background/bg16.jpg");
    }

    form .form-row input[type="text"]:focus+label[data-placeholder]:after,
    form .form-row input[type="text"]:valid+label[data-placeholder]:after,
    form .form-row input[type="text"]+label[data-placeholder]:after {
        font-size: 20px;
    }

    form .form-row input[type="text"]:focus,
    form .form-row input[type="text"]:valid,
    form .form-row input[type="text"] {
        font-size: 18px;
    }

    .btn {
        background-color: #1cb495;
        color: white;
    }
</style>

<script>
    //función que valida que sólo se ingresen números en el campo de número de jugadores
    function soloNumeros(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        //Tecla para borrar, siempre la permite
        if (tecla === 8) {
            return true;
        }

        // Patrón de entrada, en este caso solo acepta numeros
        patron = /[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
</script>

<header id="header">
    <img class="img-fluid efecto-arriba" src="images/background/welcome.png">
</header>

<form id="form" action="players_data.php" method="post">
    <div class="form-row">
        <input maxlength="1" minlength="1" class="efecto-arriba" type="text" name="jugadores" id="players" onkeypress="return soloNumeros(event)" required />
        <label alt="Label" data-placeholder="Number of Players"></label>
    </div>
</form>
<button form="form" class="btn" type="submit">Next</button>
<?php
include 'templates/pie.php';
?> 