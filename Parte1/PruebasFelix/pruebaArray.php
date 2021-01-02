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
            public $fichas;
            function __construct()
            {
                $fichas = array();
                
            }

            function meteFichas($ficha, $i){
                $this->fichas[$i][2] = $ficha;
            }
        }

        class Ficha{
            public $color = "";

            function __construct()
            {
                $color = 'blanco';
            }
            
        }

        $tablero = new Tablero();
        for($i = 0; $i < 2; $i = $i+2){
            $ficha = new Ficha();
            var_dump(new Ficha());
            $tablero->meteFichas($ficha, $i);
    echo $i;
        }
        
       
    ?>
    <pre>
        <?php
            var_dump($tablero->fichas);
            if(empty($tablero->fichas[1])){
                echo "hola";
            }
        ?>
    </pre>
</body>
</html>