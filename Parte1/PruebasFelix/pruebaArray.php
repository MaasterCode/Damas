<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        
        class Tablero{
            public $fichas = array();

            function meteFichas($ficha){
                $this->fichas[] = $ficha;
            }
        }

        class Ficha{
            public $color = 'blanco';
            public static $id = 0;
            
        }

        $tablero = new Tablero();
        for($i = 0; $i < 9 ; $i++){
            $ficha = new Ficha();
            $tablero->meteFichas($ficha);
            var_dump($ficha);
        }
       
    ?>
    <pre>
        <?php
 var_dump($tablero->fichas);
        ?>
    </pre>
</body>
</html>