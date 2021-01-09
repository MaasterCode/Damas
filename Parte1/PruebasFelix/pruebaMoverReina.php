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
    
    $posXIni = 7;
    $posYIni = 8;

    $posXFin = 1;
    $posYFin = 2;

    $posXIni = $posXIni;
    $posYIni = $posYIni;
    $posXFin = $posXFin;
    $finY = $posYFin;
    // echo $posYIni.$posYFin.'<br>';
    // echo $posYIni - $posYFin.'<br>';
    // echo $posXIni - $posXFin.'<br>';


    if ($posYIni - $posYFin < 0 && $posXIni - $posXFin < 0) { //arriba derecha
        
        for ($i = $posXIni+1; $i < $posXFin; $i++) {
           $posY++;
                echo $i . ' ' . ($posYIni) . '<br>';
            
        }
    }else if($posYIni - $posYFin < 0 && $posXIni - $posXFin > 0){  //abajo derecha
        for ($i = $posXIni-1; $i > $posXFin; $i--) {
            $posYIni++;
                 echo $i . ' ' . ($posYIni) . '<br>';
             
         }
    }else if ($posYIni - $posYFin > 0 && $posXIni - $posXFin < 0) { //Arriba iz
        for ($i = $posXIni+1; $i < $posXFin; $i++) {
            $posYIni--;
                 echo $i . ' ' . ($posYIni) . '<br>';
             
         }
    }else if ($posYIni - $posYFin > 0 && $posXIni - $posXFin > 0) { //abajo iz
        for ($i = $posXIni-1; $i > $posXFin; $i--) {
            $posYIni--;
                 echo $i . ' ' . ($posYIni) . '<br>';
             
         }
    }
    ?>
</body>

</html>