<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
        $tamaño = 10;

        $fila = array();
        $tablero = array();

        //En el juego real en vez de rellenar con " " rellenamos con casillas

        $fila = array_fill(0, 10, " ");

        $tablero = array_fill(0, 10, $fila);

        var_dump($tablero);
    ?>
    </pre>
</body>
</html>