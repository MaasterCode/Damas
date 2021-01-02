<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="felix">
    <meta name="description" content="Juego de las damas">
    <title>Damas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .tableroBox {
            margin-top: 20px;
            margin-left: 20px;
            width: calc(8 * 70px);
            height: calc(8 * 70px);
        }

        .tablero {
            display: grid;
            grid-template-columns: repeat(8, 70px);
            grid-template-rows: repeat(8, 70px);
        }

        .casillaN, .casillaB{
            position: relative;
        }

        .casillaB {
            background-color: #FFDEAD;
        }

        .casillaN {
            background-color: #8B4513;
        }

        .tablero div img {
            display: block;
            width: 65px;
            height: 65px;
            z-index: 20;
            transform: translate(5%, 5%);
        }
    </style>
</head>

<body>
    <?php
    if(!isset($_SESSION['empezado'])){
        session_start();
        $_SESSION['empezado'] = false;
    }

    require_once('juego.php');


    if($_SESSION['empezado'] == false){
        $juego = new Juego();
        $juego->comienzaJuego();
        $_SESSION['empezado'] = true;
    }else{
        $juego = $_SESSION['juego'];
    }
    
    if(isset($_POST['enviado'])){
        $posXIni = $_POST['posXIni'];
        $posYIni = $_POST['posYIni'];
        $posXFin = $_POST['posXFin'];
        $posYFin = $_POST['posYFin'];
        $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
       
    }if(isset($_POST['resetear'])){
        session_abort();
        header("Location: main.php");
    }

    if($_SESSION['empezado']){
        $juego->dibujaTablero();
        echo 'dibujado';
    }
    $_SESSION['juego'] = $juego;



    ?>
    <pre>
        <?php

        ?>
    </pre>
    <?php
    ?>
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method = "post">
    <input type="number" name = "posXIni" placeholder="posXIni">
    <input type="number" name = "posYIni" placeholder="posYIni">
    <input type="number" name = "posXFin" placeholder="posXFin">
    <input type="number" name = "posYFin" placeholder="posYFin">
    <input type="submit"  name = "enviado" value = "Enviar">
    <input type="reset" value="Resetear">
    </form>











        <pre>
        <?php
// var_dump($tablero->casillas);
// var_dump($tablero->fichas);
var_dump($juego);
        ?>
        </pre>
</body>

</html>