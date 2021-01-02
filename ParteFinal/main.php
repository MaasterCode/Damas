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

    require_once('juego.php');
    
    $juego = new Juego();
    $juego->comienzaJuego();


    ?>
    
        <pre>
        <?php
//  var_dump($tablero->casillas);
// var_dump($tablero->fichas);
        ?>
        </pre>
</body>

</html>