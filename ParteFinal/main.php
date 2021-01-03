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
        }

        body {
            display: flex;
            justify-content: space-evenly;
        }

        .juego{
            position: relative;
            top: 50%;
            transform: translateY(50%);
            display: flex;
            flex-direction: row;
            width: 80%;
            justify-content: space-around;
        }

        .tableroBox {
            width: calc(8 * var(--tamaño-casillas));
            height: calc(8 * var(--tamaño-casillas));
            border: 1px solid brown;
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
            width: 50px;
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
        }

        .formulario input {
            width: 250px;
            height: 30px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="juego">
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
            $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
        }
        if (isset($_POST['resetear'])) {
            session_abort();
            header("Location: main.php");
        }

        if ($_POST['empezado'] == true) {
            $juego->dibujaTablero();
        }

        $_SESSION['juego'] = serialize($juego);

        ?>
        <div class="formulario">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="number" name="posXIni" placeholder="posXIni">
                <input type="number" name="posYIni" placeholder="posYIni">
                <input type="number" name="posXFin" placeholder="posXFin">
                <input type="number" name="posYFin" placeholder="posYFin">
                <input type="hidden" name="empezado" value="true">
                <input type="submit" name="enviado" value="Enviar">
                <input type="reset" value="Resetear">
            </form>
        </div>





        <!-- <pre> -->
        <?php
        // var_dump($tablero->casillas);
        // var_dump($tablero->fichas);
        //var_dump($juego);
        ?>
        <!-- </pre> -->
    </div>
</body>

</html>