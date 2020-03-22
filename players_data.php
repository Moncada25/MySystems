<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<!-- Emoji Library-->
<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
<link rel="stylesheet" href="css/text.css">

<style>
    /*Body*/
    body,
    html {
        background: url("images/background/bg18.jpg");
    }

    /*Input Text*/
    input[type=text] {
        width: 100%;
        height: auto;
        background-color: transparent;
        border-top: none;
    }

    .btn {
        background-color: #1cb495;
        color: white;
    }

    form .form-row input[type="text"]:focus+label[data-placeholder]:after,
    form .form-row input[type="text"]:valid+label[data-placeholder]:after,
    form .form-row input[type="text"]+label[data-placeholder]:after {
        color: whitesmoke;
    }

    form .form-row input[type="text"]+label[data-placeholder]:after {
        top: 60%;
        font-size: 22px;
    }

    form .form-row input[type="text"]:focus,
    form .form-row input[type="text"]:valid,
    form .form-row input[type="text"] {
        border: 2px solid whitesmoke;
        border-top: none;
        margin-top: 15px;
        margin-bottom: 0px;
        font-size: 20px;
    }

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
</style>

<script>
    //función que valida que sólo se ingresen números en los campos de valor apuesta
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

    //función que valida que sólo se ingresen texto en los campos de nombre
    function soloTexto(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        //Tecla para borrar, siempre la permite
        if (tecla === 8) {
            return true;
        }

        // Patrón de entrada, en este caso solo acepta texto
        patron = /[a-z,A-Z]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
</script>

<?php
$jugadores = (int)$_POST['jugadores'];

if (empty($jugadores)) { ?>
<header id="header" class="efecto-arriba">
    <i class='em em-thinking_face'></i>
    <h1>No Players</h1>
    <img class="img-fluid" src="images/background/gif2.gif">
</header>
<a href=ruleta.php style="font-size: 25px;font-family: Times New Roman;color: #1cb495">Return</a>
<?php 
} else {
    ?>
<header id="header" class="efecto-abajo">
    <h1>Enter The Following Data</h1>
</header>

<form method="post" action="game.php">
    <input type="hidden" name="numeroGanador" value="69">
    <input type=hidden name=jugadores value="<?php echo $_POST['jugadores'] ?>">

    <table class="table table-dark table-striped efecto-abajo">
        <thead>
            <tr>
                <th width="50%">
                    <div class="titulos">Name</div>
                </th>
                <th width="50%">
                    <div class="titulos">How much money do you have?</div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $jugadores; $i++) { ?>
            <tr>

                <td width="50%">
                    <div class="form-row">
                        <input maxlength="20" id="nombre1" type="text" name="nombre<?php echo ($i + 1) ?>" onkeypress="return soloTexto(event)" required />
                        <label alt="Label" data-placeholder="Player <?php echo ($i + 1) ?>"></label>
                    </div>
                </td>

                <td width="50%">
                    <div class="form-row">
                        <input maxlength="10" type="text" name="saldo<?php echo ($i + 1) ?>" onkeypress="return soloNumeros(event)" required />
                        <label alt="Label" data-placeholder="Money"></label>
                    </div>
                </td>

            </tr>
            <?php 
        } ?>
        </tbody>
    </table>
    <button class="btn efecto-abajo" type="submit">Start</button>
</form>

<?php 
}
include 'templates/pie.php';
?> 