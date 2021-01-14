<!DOCTYPE html>
<?php
session_start();
?>
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
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            position: absolute;
            top: 0;
            min-height: 100vh;
            width: 100%;
            background: #f7f7f7;
        }

        header {
            height: 5vh;
            min-height: 80px;
            position: relative;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly;
        }


        main {
            display: flex;
            align-items: center;
            flex-direction: column;
            height: 70vh;
            padding: 10px;
            width: 100%;
        }


        header span {
            font-weight: 600;
        }

        .juego {
            position: absolute;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            width: 100vw;
            min-height: 70vh;
        }

        .tableroBox {
            position: absolute;
            left: 50px;
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


        .tablero p {
            position: absolute;
            top: 55%;
            transform: translate(-50%, -50%);
            left: 50%;
            font-size: 20px;
            z-index: 10;
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
            z-index: 9;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .tablero .reinaBlanca {
            width: 50px;
            top: 22px;
        }

        .formulario {
            width: 400px;
            position: absolute;
            left: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 15px;
            padding: 10px;
        }

        .formulario label {
            margin-bottom: 20px;
            font-size: 20px;
        }

        .formulario input,
        .formulario button {
            width: 100px;
            height: 30px;
            margin: 10px 0 10px 0;
        }

        .formulario#formulario input#finalOrigen,
        input#finalDestino {
            margin-bottom: 20px;
        }

        #formulario {
            width: 300px;
            padding: 20px 20px;
        }

        .perdedor {
            height: 10%;
            font-size: 35px;
            text-align: center;
        }


        .errores {
            position: absolute;
            top: 70px;
            right: 40px;
            height: 15vh;
            width: 250px;
            padding: 10px;
        }

        .ficha {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 85%;
            height: 85%;
            clip-path: circle(50px at center);
            border-radius: 50%;
        }

        .fichaBlanca {
            background: white;
        }

        .fichaNegra {
            background: black;
        }

        .dama{
            position: absolute;
            top: -5px;
            left: -3px;
        }

        .damaNegra,
        .damaBlanca {
            width: calc(var(--tamaño-casillas) + 6px);
            height: calc(var(--tamaño-casillas) + 6px);
        }

        .poligonoBlanco {
            position: relative;
            width: 100%;
            height: 100%;
            clip-path: polygon(30% 75%, 68.67% 75.00%, 88.67% 37.33%, 62.34% 50%, 48.67% 13.33%, 35% 50%, 8.66% 38%);
            background: white;
        }

        .poligonoNegro {
            position: relative;
            width: 100%;
            height: 100%;
            clip-path: polygon(30% 75%, 70% 75%, 88.67% 37.33%, 62.34% 50%, 48.67% 13.33%, 35% 50%, 8.66% 38.00%);
            background: black;
        }

        .tablero .corona {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .coronaBlanca {

            background: white;
        }

        .coronaNegra {

            background: black;
        }

        .corona:nth-child(2) {
            left: 5%;
            top: 33%;
        }

        .corona:nth-child(3) {
            left: 41%;
            top: 10%;
        }

        .corona:nth-child(4) {
            right: 4%;
            top: 33%;
        }

        .pNegro {
            color: black;
        }

        .pBlanco {
            color: white;
        }


        @media screen and (max-width: 1400px) {
            * {
                --tamaño-casillas: 50px;
                --tamaño-imagen: 40px;
            }

            #formulario {
                width: 250px;
            }

            .formulario {
                left: 50%;
                width: 250px;
            }

            .formulario label {
                font-size: 17px;
            }

            .formulario input {
                width: 80px;
                height: 25px;
            }

            .tablero p{
                font-size: 16px;
            }

        }

        @media screen and (max-width: 1000px) {
            .errores {
                right: 0px;
                width: 225px;
            }
        }

        @media screen and (max-height: 1000px) and (min-width: 1400px) {
            .juego {
                top: 250px;
            }
        }
    </style>
</head>

<body>

    <?php
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
        if ($juego->sePuedeComer($posXIni, $posYIni)) {

            $juego->comer($posXIni, $posYIni, $posXFin, $posYFin);
        } else {

            $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
        }
        $juego->promocion();
    }
    if ($juego->comprobarFichas()) {
    ?>
        <header>
            <div class="turno">
                <h4>Turno:</h4>
                <p>Le toca jugar a
                    <span>
                        <?php
                        if (strcmp($juego->getTurno(), "blanco") === 0) {
                            echo 'blancas';
                        } else if (strcmp($juego->getTurno(), "negro") === 0) {
                            echo 'negras';
                        }
                        ?>
                    </span>
                    <?php
                    if ($juego->sePuedeComer()) {
                    ?>
                        ,<br> le toca comer
                    <?php
                    }
                    ?>
                </p>
            </div>
            <div class="titulo">
                <h3>El juego de las damas</h3><br>
                <p>Por Belmont y Felix</p>
            </div>
            <div class="score">
                <h3>Fichas en juego:</h3>
                <p>Blancas <?php echo $juego->getNumBlancas() ?></p>
                <p>Negras <?php echo $juego->getNumNegras() ?></p>
            </div>
        </header>
        <main>
            <div class="juego">
                <?php

                if ($_POST['empezado'] == true) {
                    $juego->dibujaTablero();
                }

                $_SESSION['juego'] = serialize($juego);
                ?>
                <div class="formulario">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="formulario">
                        <label for="origen">Origen</label><br>
                        <input type="number" name="posXIni" id="origen" placeholder="X" required="required" max="8" min="1">
                        <input type="number" name="posYIni" id="finalOrigen" placeholder="Y" required="required" max="8" min="1"><br>
                        <label for="detino">Destino</label><br>
                        <input type="number" name="posXFin" id="destino" placeholder="X" required="required" max="8" min="1">
                        <input type="number" name="posYFin" id="finalDestino" placeholder="Y" required="required" max="8" min="1">
                        <input type="hidden" name="empezado" value="true">
                        <input type="reset" value="Resetear">
                        <input type="submit" value="Enviar" name="enviado">
                    </form>
                </div>

                <div class="errores">
                    <h4>Errores</h4>
                    <?php

                    if (count($juego->getErrores()) > 0) {
                        $juego->mostrarErrores();
                    }
                    ?>
                </div>
            </div>
        <?php
    } else {

        ?>
            <div class="perdedor">
                <?php
                if ($juego->getNumNegras() < 1) { ?>
                    <p>Han perdido las negras</p>
                <?php
                } else if ($juego->getNumBlancas() < 1) { ?>
                    <p>Han perdido las blancas</p>
                <?php
                }
                session_reset();
                ?>
                <a href="./main.php">Volver a jugar</a>
            </div>
        <?php
    }
        ?>

        </main>
</body>

</html>