<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $myarray = array();

    $posXIni = 8;
    $posYIni = 8;

    $posXFin = 1;
    $posYFin = 1;

    $posXIni = $posXIni;
    $posYIni = $posYIni;
    $posXFin = $posXFin;
    $finY = $posYFin;
    // echo $posYIni.$posYFin.'<br>';
    // echo $posYIni - $posYFin.'<br>';
    // echo $posXIni - $posXFin.'<br>';


    // if ($posYIni - $posYFin < 0 && $posXIni - $posXFin < 0) { //arriba derecha

    //     for ($i = $posXIni + 1; $i < $posXFin; $i++) {
    //         $posYIni++;
    //         if ($tablero->casillas[$i][$posYIni]->ocupado == false) {
    //         } else if ($tablero->casillas[$i][$posYIni]->ocupado == true) {
    //             array_push($errores, "Hay una pieza delante");
    //             break;
    //         }
    //     }
    // } else if ($posYIni - $posYFin < 0 && $posXIni - $posXFin > 0) {  //abajo derecha
    //     for ($i = $posXIni - 1; $i > $posXFin; $i--) {
    //         $posYIni++;
    //         if ($tablero->casillas[$i][$posYIni]->ocupado == false) {
    //         } else if ($tablero->casillas[$i][$posYIni]->ocupado == true) {
    //             array_push($errores, "Hay una pieza delante");
    //             break;
    //         }
    //     }
    // } else if ($posYIni - $posYFin > 0 && $posXIni - $posXFin < 0) { //Arriba iz
    //     for ($i = $posXIni + 1; $i < $posXFin; $i++) {
    //         $posYIni--;
    //         if ($tablero->casillas[$i][$posYIni]->ocupado == false) {
    //         } else if ($tablero->casillas[$i][$posYIni]->ocupado == true) {
    //             array_push($errores, "Hay una pieza delante");
    //             break;
    //         }
    //     }
    // } else if ($posYIni - $posYFin > 0 && $posXIni - $posXFin > 0) { //abajo iz
    //     for ($i = $posXIni - 1; $i > $posXFin; $i--) {
    //         $posYIni--;
    //         if ($tablero->casillas[$i][$posYIni]->ocupado == false) {
    //         } else if ($tablero->casillas[$i][$posYIni]->ocupado == true) {
    //             array_push($errores, "Hay una pieza delante");
    //             break;
    //         }
    //     }
    // }

    if ($posXIni - $posXFin < 0) {  //Arriba

        if ($posYIni - $posYFin > 0) {
            $suma = 1;
        } else if ($posYIni - $posYFin < 0) {
            $suma = -1;
        }
        for ($i = $posXIni + 1; $i < $posXFin; $i++) {
            $posYIni += $suma;
            echo $i . ' ' . $posYIni;
            if ($this->tablero->casillas[$i][$posYIni]->ocupado == false) {
            } else if ($this->tablero->casillas[$i][$posYIni]->ocupado == true) {
                array_push($this->errores, "Hay una pieza delante");
                break;
            }
        }
    } else if ($posXIni - $posXFin > 0) {  //Abajo

        if ($posYIni - $posYFin > 0) {
            $suma = 1;
        } else if ($posYIni - $posYFin < 0) {
            $suma = -1;
        }
        for ($i = $posXIni - 1; $i > $posXFin; $i--) {
            $posYIni += $suma;
            echo $i . ' ' . $posYIni . '<br>';
            if ($this->ablero->casillas[$i][$posYIni]->ocupado == false) {
            } else if ($this->tablero->casillas[$i][$posYIni]->ocupado == true) {
                array_push($this->errores, "Hay una pieza delante");
                break;
            }
        }
    }
    ?>
</body>

</html>