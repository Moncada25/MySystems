<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="http://subirimagen.me/uploads/20181224100052.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Systems</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/config.css">
</head>

<style>
        html, body {
            background:url("http://subirimagen.me/uploads/20181203110229.jpg");
        }
 </style>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="font-family: Times New Roman; font-size: 20px;">
        <a class="navbar-brand" href="index.php">
        <img class="img-fluid" src="http://subirimagen.me/uploads/20181224100052.png">
        Home
        </a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse" style="font-family: Times New Roman; font-size: 20px;">
            <ul class="navbar-nav mr-auto"> 
                <li class="nav-item active">
                    <a class="nav-link" href="mostrarCarrito.php">
                    <img class="img-fluid" src="http://subirimagen.me/uploads/20181202215236.png">
                    Carrito(<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="ruleta.php">
                    <img class="img-fluid" src="http://subirimagen.me/uploads/20181202215122.png">
                    Play Free
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="science.php">
                    <img class="img-fluid" src="http://subirimagen.me/uploads/20181203004055.png">
                    Science
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="programming.php">
                    <img class="img-fluid" src="http://subirimagen.me/uploads/20181203004318.png">
                    Programming
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="services.php">
                    <img class="img-fluid" src="http://subirimagen.me/uploads/20190106203032.png">
                    Services
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <br/>
    <br/>
    <br/>
    <br/>

    <div class="container-fluid">