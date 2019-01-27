<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
include "libs/recaptcha/recaptchalib.php";
?>

<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
<link rel="stylesheet" href="css/text.css">
<link rel="stylesheet" href="css/radio.css">

<style>

    form .form-row input[type="text"]:focus + label[data-placeholder]:after, form .form-row input[type="text"]:valid + label[data-placeholder]:after,
    form .form-row input[type="text"] + label[data-placeholder]:after{
        color: black;
        font-size: 22px;
    }

    form .form-row input[type="text"] {
        color: black;
    }

    form .form-row input[type="text"]:focus, form .form-row input[type="text"]:valid,
    form .form-row input[type="text"] {
        border: 2px solid black;
        border-top: none;
        font-size: 18px;
        background-color: transparent;
    }

    .btn{
        font-size: 22px;
        background-color: #1cb495;
        color: black;
    }

    h1{
        font-size: 45px;
        font-family: Times New Roman;
        color: #1cb495;
    }

    h2{
        font-size: 30px;
        font-family: Times New Roman;
        color: #1cb495;
        margin-bottom: 18px;
        margin-top: 18px;
    }

    .text-xs-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }

    label{
        font-size: 20px;
        font-family: Times New Roman;
    }

</style>

<?php 

if($_POST){ 

    $secret = "6Ldqz4kUAAAAAPFjMEUi772sxV7P9DV2zBuaBAYd";
    $response = null;
    // comprueba la clave secreta
    $reCaptcha = new ReCaptcha($secret);

    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
        );
    }

    if ($response != null && $response->success) {?>
        
        <div class="jumbotron text-center">
            <?php 
            
            include "libs/PHPMailer-master/src/PHPMailer.php";
            include "libs/PHPMailer-master/src/SMTP.php";

            $email_user = "packappsmysystems@gmail.com";
            $email_password = "canserbero123";
            $the_subject = "Solicitud de Servicio";
            $address_to = "zanti4020@gmail.com";
            $from_name = "My Systems";
            $phpmailer = new PHPMailer\PHPMailer\PHPMailer();
            // ---------- datos de la cuenta de Gmail -------------------------------
            $phpmailer->Username = $email_user;
            $phpmailer->Password = $email_password; 
            //-----------------------------------------------------------------------
            //$phpmailer->SMTPDebug = 1;
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->Host = "smtp.gmail.com"; // GMail
            $phpmailer->Port = 465;
            $phpmailer->IsSMTP(); // use SMTP
            $phpmailer->SMTPAuth = true;
            $phpmailer->setFrom($phpmailer->Username,$from_name);
            $phpmailer->AddAddress($address_to); // recipients email
            $phpmailer->Subject = $the_subject;
            $phpmailer->Body .= "<h1 style='color:#1cb495;'>Tipo de Servicio</h1><h2>".openssl_decrypt($_POST['servicio'], COD, KEY)."</h2>";
            $phpmailer->Body .= "<h1 style='color:#1cb495;'>Contacto</h1><h2>". $_POST['contacto'] ."</h2>";
            $phpmailer->Body .= "<h1 style='color:#1cb495;'>Detalles</h1><h2>".$_POST['texto']."</h2>";
            $phpmailer->IsHTML(true);
            $phpmailer->Send();

            ?>
            <h1 class="display-4">¡Servicio Solicitado!</h1>
            <hr class="my-4">
            <h2>Gracias por contar con nosotros, en breve responderemos su solicitud.</h2>
        </div>

    <?php

    } else { ?>
    
        <div class="alert alert-danger" style="font-family: Times New Roman; font-size: 22px;">
            Por favor, comprueba que no eres un robot, Mr. Robot.
        </div>

        <?php getForm(); ?>

<?php }

}else{ 
    getForm();
}

function getForm(){ ?>

    <div class="jumbotron text-center">
        <form id="form" action="" method="post">
            <h1 class="display-4">Formulario de Solicitud</h1>
            <hr class="my-4">
            <h2>Tipo de Soporte</h2>
            <div class="funkyradio">
                <div class="funkyradio-color">
                    <input type="radio" name="servicio" id="radio3" value="<?php echo R3; ?>" checked/>
                    <label for="radio3">Desarrollador</label>
                </div>
                <div class="funkyradio-color">
                    <input type="radio" name="servicio" id="radio2" value="<?php echo R2; ?>"/>
                    <label for="radio2">PC</label>
                </div>
                <div class="funkyradio-color">
                    <input type="radio" name="servicio" id="radio1" value="<?php echo R1; ?>" />
                    <label for="radio1">Smartphones</label>
                </div>
            </div>

            <h2>Contacto</h2>
            <div class="form-row">
                <input type="text" name="contacto" id="contacto" required />
                <label alt="Label" data-placeholder="Email/WhatsApp"></label>
            </div>

            <h2>Detalles del Servicio</h2>
            <textarea name="texto" id="texto" maxlength="500" required></textarea>
            <div class="text-xs-center">
                <div class="g-recaptcha" data-sitekey="6Ldqz4kUAAAAAJk2pw9f-nzH0SWDfJrDb9OKxIeY"></div>
            </div>
        </form> 
        <button form="form" class="btn" type="submit">Solicitar</button>
    </div>

<?php }
include 'templates/pie.php';
?>

    