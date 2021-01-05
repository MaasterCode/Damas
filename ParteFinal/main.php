<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="authors" content="Felix&Belmont">
    <meta name="description" content="Juego de las damas">
    <title>Damas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            --tamaño-casillas: 60px;
            --tamaño-imagen: 50px;
        }

        body {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: row;
        }

        .juego{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: row;
            width: 80%;
            justify-content: space-around;
        }

        .tableroBox {
            width: calc(8 * var(--tamaño-casillas));
            height: calc(8 * var(--tamaño-casillas));
            border: 1px solid brown;
            margin: 15px;
        }

        .tablero {
            display: grid;
            grid-template-columns: repeat(8, var(--tamaño-casillas));
            grid-template-rows: repeat(8, var(--tamaño-casillas));
        }

        .tablero div {
            position: relative;
        }

        .casillaB {
            background-color: #FFDEAD;
        }

        .casillaN {
            background-color: #8B4513;
        }

        .tablero div img {
            position: relative;
            display: block;
            width: var(--tamaño-imagen);
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .formulario {
            width: 400px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 15px;
        }

        .formulario label{
            margin-bottom: 20px;
        }

        .formulario input {
            width: 250px;
            height: 30px;
           
        }

        .formulario input {
            margin: 5px 0 5px 0;
        }

        .formulario input#finalOrigen, input#finalDestino {
            margin-bottom: 20px;
        }    </style>
</head>

<body>
        <?php

        session_start();


        require_once('juego.php');


        if (!isset($_POST['empezado'])) {
            $juego = new Juego();
            $juego->comienzaJuego();
            $_POST['empezado'] = true;
        } else {
            $juego = unserialize($_SESSION['juego']);
        }

        if (isset($_POST['enviado'])) {
            $posXIni = $_POST['posXIni'];
            $posYIni = $_POST['posYIni'];
            $posXFin = $_POST['posXFin'];
            $posYFin = $_POST['posYFin'];

            if ($juego->sePuedeComer()) {
                echo "toca comer";
                $juego->comer($posXIni, $posYIni, $posXFin, $posYFin);
                
            } else {
                echo "toca mover";
                $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
            }
        }
        ?>
        <div class="turno">
            <p>Le toca jugar al <?php echo $juego->turno?></p>
        </div>
        <div class="juego">
        <?php

        if ($_POST['empezado'] == true) {
            $juego->dibujaTablero();
        }

        $_SESSION['juego'] = serialize($juego);

        ?>
        <div class="formulario">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="origen">Origen</label><br>
                <input type="number" name="posXIni" id="origen" placeholder="X" required="required" max = "8" min="1">
                <input type="number" name="posYIni" id = "finalOrigen" placeholder="Y" required="required" max = "8" min="1"><br>
                <label for="detino">Destino</label><br>
                <input type="number" name="posXFin" id="destino" placeholder="X" required="required" max = "8" min="1">
                <input type="number" name="posYFin" id = "finalDestino" placeholder="Y" required="required" max = "8" min="1">
                <input type="hidden" name="empezado" value="true">
                <input type="submit" name="enviado" value="Enviar">
                <input type="reset" value="Resetear">
            </form>
        </div>





         <!--<pre>--> 
        <?php
        // var_dump($tablero->casillas);
        //var_dump($juego->tablero->fichas);
        //var_dump($juego);
        echo $juego->turno.'<br>';
        if(count($juego->errores) > 0){
            $juego->mostrarErrores();
        }
        ?>
         <!--</pre>--> 
    </div>
</body>

</html>