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
        }

        header {
            height: 5vh;
            min-height: 80px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }


        main {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: column;
            height: 70vh;
            padding: 10px;
            width: 100%;
        }

        .info {
            display: flex;
            position: relative;
            flex-direction: row;
            justify-content: space-between;
            min-width: 400px;
            width: 75vw;
        }

        .info span {
            font-weight: 600;
        }

        .juego {
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            width: 100vw;
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


        .tablero p {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
            color: white;
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

        .formulario {
            width: 400px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 15px;
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
            height: 15vh;
        }


        @media screen and (max-width: 1400px) {
            * {
                --tamaño-casillas: 50px;
                --tamaño-imagen: 40px;
            }

            #formulario {
                width: 250px;
            }

            .formulario label {
                font-size: 17px;
            }

            .formulario input {
                width: 80px;
                height: 25px;
            }

            .info{
                top: 30px;
            }
        }
        
    </style>
</head>

<body>
    <header>
        <h3>El juego de las damas</h3><br>
        <p>Por Belmont y Felix</p>
    </header>
    <main>
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
            if ($juego->sePuedeComer()) {

                $juego->comer($posXIni, $posYIni, $posXFin, $posYFin);
            } else {

                $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
            }
        }
        if ($juego->comprobarFichas()) {
        ?>
            <div class="info">
                <div class="turno">
                    <p>Le toca jugar a
                        <span>
                            <?php
                            if (strcmp($juego->turno, "blanco") === 0) {
                                echo 'blancas';
                            } else if (strcmp($juego->turno, "negro") === 0) {
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
                <div class="score">
                    <h3>Puntuación:</h3>
                    <p>Fichas blancas <?php echo $juego->numBlancas ?></p>
                    <p>Fichas negras <?php echo $juego->numNegras ?></p>
                </div>
            </div>

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
                    <?php

                    if (count($juego->errores) > 0) {
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
                if ($juego->numNegras < 1) { ?>
                    <p>Han perdido las negras</p>
                <?php
                } else if ($juego->numBlancas < 1) { ?>
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