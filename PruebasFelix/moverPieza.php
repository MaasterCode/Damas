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
        $fila = array(" ", " ", " ");
        //$tablero = array(array(" ", " ", " "), array(" ", " ", " "), array(" ", " ", " "));
        $tablero = array_fill(0, 3, $fila);
       
        function montaTablero(){
            global $tablero;
            for($i = 0; $i < count($tablero); $i++){
                for($j = 0; $j < count($tablero[$i]); $j++){
                    if(($i + $j)%2 == 0){
                        $tablero[$i][$j] = 'x';
                    }else{
                        $tablero[$i][$j] = ' ';
                    }

                }
            }    
        }
        function moverFicha($posIniX, $posIniY, $posFinX, $posFinY){
            global $tablero;
            $tablero[$posIniX][$posIniY] = " ";
            $tablero[$posFinX][$posFinY] = "x";
        }
        montaTablero();
        var_dump($tablero);
    ?>
    <p>Mueve</p>
    <?php
        moverFicha(0, 0, 0, 1);
        var_dump($tablero);
    ?>
</pre>
</body>
</html>