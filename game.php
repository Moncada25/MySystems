<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
include 'player.php';

$seleccionado;
$off; //cuando sea true es porque todos los jugadores se han quedado sin saldo

$numeroJugadores = (int) $_POST['jugadores'];
$saldos = [$numeroJugadores];
$jugadores = [$numeroJugadores];

$numeroGanador = (int) $_POST['numeroGanador'];

for ($i = 0; $i < $numeroJugadores; $i++) {

    $saldos[$i] = (double) $_POST['saldo' . ($i + 1)];
    $jugador = new Jugador($_POST['nombre' . ($i + 1)]);

    if ($jugador instanceof Jugador) {
        $jugadores[$i] = $jugador;
    }
}

if ($numeroGanador != 69) {

    for ($i = 0; $i < $numeroJugadores; $i++) {
        $jugadores[$i]->setNumeroRuleta((int) $_POST['txtNapuesta' . ($i + 1)]);
        $jugadores[$i]->setValorApuesta((double) $_POST['apuesta' . ($i + 1)]);
    }
    $off = false;
}
?>

    <!-- JavaScript Files-->
    <script src="js/TweenMax.min.js" type="text/javascript"></script>
    <script src="js/Winwheel.min.js" type="text/javascript"></script>

    <style>

        /*Body*/
        body, html{
            background:url("images/bg41.jpg");
        }

        /*Input Text*/
        input[type=text] {
            width: 100%;
            height: 45px;
            text-align: center;
            border-radius: 15px;
            outline:none;
            background-color: transparent;
            display: block;
            color: whitesmoke;
            margin: 0 auto;
            font-size: 25px;
            font-style: italic;
            font-family:"Times New Roman";
        }

        select{
            -webkit-appearance: none;
            width: 100%;
            height: 45px;
            background-color: transparent;
            border-top: 20px;
            border-radius: 10px;
            outline:none;
            color: whitesmoke;
            text-align-last: center;
            font-size: 25px;
            font-weight: bold;
            display: inline-block;
            font-style: italic;
            font-family:"Times New Roman";
            cursor: pointer;
        }

        option{
            color:#1cb495;
            font-size: 25px;
            font-weight: bold;
            font-style: italic;
        }

        #canvasContainer{
            background-image: url(images/icon.png);
            background-repeat: no-repeat;  
            background-position: center;
            text-align: center;
            text-align-last: center;
            cursor: pointer;
        }

        .titulos{
            font-size: 30px;
            font-family: "Times New Roman";
            color: #1cb495;
        }

        .texto{
            font-family: "Times New Roman";
            font-size: 25px;
        }

        h1, h2, h3 {
            color: whitesmoke;
            font-family:"Times New Roman";
        }

        h1 {
            font-size: 2.5em;
            color: #1cb495;
        }

        h2 {
            font-size: 2.0em;
        }

        h3 {
            font-size: 1.75em;
        }

    </style>

    <audio id="giro">
        <source src="giro.mp3" />
    </audio>

    <?php
    //si todos los jugadores se quedan sin saldo se indica con un mensaje y activa el off
    if ($jugadores[0]->todosPerdieron($saldos)) { ?>
        <div class="alert alert-danger" style="font-family: Times; font-size: 22px">
            <h2 class="alert-heading">GAME OVER</h2>
            <h3 class="alert-heading">No player has money</h3>
        </div>
<?php 
        $off = true;
    } else {
        $off = false;
    }

    if (!$off) {
        //CANVAS (OBJETO RULETA) si ningún jugador tiene saldo no se mostrará

        if ($_POST['numeroGanador'] != 69) {

            echo "<div class='alert alert-success'>";
            echo "<h2 class='alert-heading'>Congratulations to the winners</h2>";
            echo "<h3 class='alert-heading'>Winning number → " . $numeroGanador . "</h3>";
            echo "</div>";
        }
        
        ?>
        
        <br>
        <div id=canvasContainer>
            <canvas id='canvas' height="500" width="500" onclick=miRuleta.startAnimation();></canvas>
        </div>

        <script>
            var miRuleta = new Winwheel({
                'numSegments': 21,
                'outerRadius': 250,
                'textOrientation': 'curved',
                'textFontFamily': 'Times',
                'textFontSize': 30,
                'textFillStyle': 'white',
                'textFontWeight': '100',
                'textAlignment': 'outer',
                'innerRadius': 60,
                'segments': [
                    {'fillStyle': '#019801', 'text': '0'},
                    {'fillStyle': '#111111', 'text': '3'},
                    {'fillStyle': '#dc4632', 'text': '6'},
                    {'fillStyle': '#111111', 'text': '9'},
                    {'fillStyle': '#dc4632', 'text': '12'},
                    {'fillStyle': '#111111', 'text': '15'},
                    {'fillStyle': '#dc4632', 'text': '18'},
                    {'fillStyle': '#111111', 'text': '11'},
                    {'fillStyle': '#dc4632', 'text': '2'},
                    {'fillStyle': '#111111', 'text': '5'},
                    {'fillStyle': '#019801', 'text': '0'},
                    {'fillStyle': '#111111', 'text': '8'},
                    {'fillStyle': '#dc4632', 'text': '19'},
                    {'fillStyle': '#111111', 'text': '13'},
                    {'fillStyle': '#dc4632', 'text': '16'},
                    {'fillStyle': '#111111', 'text': '1'},
                    {'fillStyle': '#dc4632', 'text': '4'},
                    {'fillStyle': '#111111', 'text': '7'},
                    {'fillStyle': '#dc4632', 'text': '10'},
                    {'fillStyle': '#111111', 'text': '17'},
                    {'fillStyle': '#dc4632', 'text': '14'}
                ],
                'animation': {
                    'type': 'spinToStop',
                    'duration': 3,
                    'callbackFinished': 'Winner()',
                    'callbackAfter': 'dibujarIndicador()'
                }         
            });
            
            dibujarIndicador();

            //función para obtener el segmento ganador
            function Winner() {

                SegmentoSeleccionado = miRuleta.getIndicatedSegment();

                //Reinicia la ruleta
                miRuleta.stopAnimation(false);
                miRuleta.rotationAngle = 0;
                miRuleta.draw();
                dibujarIndicador();
                
                document.getElementsByName("numeroGanador")[0].value = SegmentoSeleccionado.text;
                document.getElementsByName("Ruleta")[0].submit();
            }

            var sonar = true;

            //función para dibujar el indicador de la ruleta
            function dibujarIndicador() {

                if(sonar){
                    var giro = document.getElementById('giro');
                    giro.play();
                    sonar = false;
                }
  
                var canvas = document.getElementById('canvas');

                if (canvas.getContext){
                    var ctx = canvas.getContext('2d');
                }

                ctx.beginPath();
                ctx.fillStyle = "white";
                ctx.arc(250, 70, 12, 0, Math.PI*2, true); 
                ctx.closePath();
                ctx.fill();
            }

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
            numeroGanador
        </script>
 
        <!-- TABLA -->
        <!-- form donde se muestran los divs de cada jugador -->
        <form name=Ruleta method=post action=game.php>

            <input type=hidden name=numeroGanador>
            <input type=hidden name=jugadores value="<?php echo $numeroJugadores?>">
            <input type=hidden name=btnEnviar value=No>
            <br>
            <table class='table table-dark table-striped'>
                <thead>
                  <tr>
                        <th><div class=titulos>Name</div></th>
                        <th><div class=titulos>State</div></th>
                        <th><div class=titulos>Balance</div></th>
                        <th><div class=titulos>Bet Value</div></th>
                        <th><div class=titulos>Bet #</div></th>
                 </tr>
                </thead>
                <tbody>

        <?php 
        //iteración para mostrar la información del jugador i + 1
        for ($i = 0; $i < $numeroJugadores; $i++) {

            echo "<tr>";

            if ($saldos[$i] != 0) {
                echo "<td><div class=texto>" . $jugadores[$i]->getNombre() . "</div></td>";
            } else {
                echo "<td><div style='font-size: 25px; font-family: Times New Roman; color: red'>" . $jugadores[$i]->getNombre() . "</div></td>";
            }

            $seleccionado = (int) $jugadores[$i]->getNumeroRuleta();

            //etiquetas ocultas donde se guardan localmente los atributos
            echo "<input type=hidden name=nombre" . ($i + 1) . " value=" . $jugadores[$i]->getNombre() . " />";
            echo "<input type=hidden name=saldo" . ($i + 1) . " value=0>";
            echo "<input type=hidden name=apuesta" . ($i + 1) . " value=0>";
            echo "<input type=hidden name=txtNapuesta" . ($i + 1) . " value=69>";

            //actualiza el saldo
            $saldos[$i] = $jugadores[$i]->actualizarSaldo($numeroGanador, $saldos[$i], $jugadores[$i]);
            echo "<input type=hidden name=saldo" . ($i + 1) . " value=" . $saldos[$i] . ">";

            //si aún tiene saldo se muestra el div del jugador
            if ($saldos[$i] != 0) {

                //verifica que no sea la primera jugada
                if ($numeroGanador != 69) {

                    //se valida si gana o no
                    //se verifica si el saldo es suficiente para hacer la apuesta y si la apuesta está vacía

                    if ($jugadores[$i]->saldoInsuficiente($saldos[$i], $jugadores[$i])) {
                        echo "<td><div class=texto>Insufficient Money</div></td>";
                    } else if ($jugadores[$i]->getValorApuesta() == 0) {
                        echo "<td><div class=texto>Bet Empty</div></td>";
                    } else if ($jugadores[$i]->jugadorGanador($numeroGanador, $jugadores[$i])) {
                        echo"   <td><div class=texto>Winner</div></td>";
                    } else {
                        echo"   <td><div class=texto>Loser</div></td>";
                    }
                } else if ($numeroGanador == 69) {
                    echo "<td><div class=texto>Good Luck</div></td>";
                }

                //si nungún jugador tiene saldo (off = true) no se mostrará el mensaje
            } else {

                if (!$off) {
                    echo "<td><div class=texto>Game Over</div></td>";
                }
            }

            echo " <td><div class=texto>$saldos[$i]</div></td>";

            if ($saldos[$i] != 0) {

                echo "<td><input maxlength=10 type=\"text\" name=\"apuesta" . ($i + 1) . "\" onkeypress=\"return soloNumeros(event)\" value=" . $jugadores[$i]->getValorApuesta() . " placeholder=\"Enter your bet\" /></td>";

                echo " <td>";

                echo"       <select name=txtNapuesta" . ($i + 1) . ">";

                for ($j = 0; $j <= 19; $j++) {

                    if ($j == $seleccionado) {
                        echo "<option value='" . $j . "' selected>#" . $j . "</option>";
                    } else {
                        echo "<option value='" . $j . "'>#" . $j . "</option>";
                    }
                }
                echo"        </select>";
                echo " </td>";
            } else {

                echo "<td><input maxlength=10 type=\"text\" name=\"apuesta" . ($i + 1) . "\"value='Blocked' disabled /></td>";

                echo "<td>";

                echo"<select name=txtNapuesta" . ($i + 1) . " disabled>";
                echo "<option style=\"color:#1cb495\" selected>Blocked</option>";
                echo" </select>";
                echo "</td>";
            }

            echo "          </tr>";
        }
        echo "      </tbody>";
        echo "  </table>";
        echo "</form>";
    }
    ?>

<?php
include 'templates/pie.php';
?>