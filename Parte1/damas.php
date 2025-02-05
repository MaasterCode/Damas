<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damas</title>
    <meta name="author" content="Felix">
    <meta name="description" content="El tablero del juego de las damas">
    <style>
        .tablero {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-auto-rows: 1fr;
            width: 450px;
            height: 450px;
        }

        .tablero div {
            border: 1px solid black;
            width: 45px;
            height: 45px;

        }

        .tablero div:nth-child(2n) {
            background: grey;
            z-index: -1;
        }

        p{
            position: absolute;
        }

        .par{
            position: absolute;
            right: 50px;
        }

        .par:nth-of-type(even){
            bottom: 100px;

        }
    </style>
</head>

<body>

    <?php

    class Tablero
    {
        public $casillas;
        public $piezas;

        function __construct()
        {
            $this->casillas = array();
            $this->casillas = array_fill(0, 10, array());
            $this->blancas = array();
            $this->negras = array();
        }

        //Para rellenar el tablero en el orden de la y

        function construyeTablero()
        {

            for ($i = 0; $i < count($this->casillas); $i++) {
                $this->casillas[$i] = array_fill(0, 10, array());
            }
        }

        //Para que devuelva el array de casillas (El tablero)

        function getTablero()
        {
            return $this->casillas;
        }

        //Para que devuelva una casilla en concreto

        function getCasilla($posX, $posY)
        {
            return $this->casillas[$posX][$posY];
        }

        function getPiezas(){
            return $this->negras;
        }

        //Es un bucle anidado para crear en el array de tablero las casillas

        function rellenaTableroDeCasillas()
        {
            for ($i = 0; $i < count($this->casillas); $i++) {
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    $this->casillas[$i][$j] = new Casilla($i, $j);
                }
            }
        }

        function crearFichas(){
            // for ($i = 0; $i < 3; $i++) {
            //     // ($i % 2) == 0 ? $j = 0: $j = 1;
            //     for ($j=0; $j < 5; $j+2) {
                    
                        // $this->negras[$i][$j] = new Pieza($i, $j, 'negro');
                    
            //     }
            // }

        //     for ($i = count($this->casillas) - 1; $i > count($this->casillas)-4; $i--) {
        //         for ($j = $i%2; $j < 5 - $i%2; $j+2) {
                    
        //                 $this->negras[$i][$j] = new Pieza($i, $j, 'blanco');
                    
        //         }
        //     }
        }
        
        //Rellena el tablero de fichas, esto solo se hace inicialmente


        function rellenaTableroDeFichas()
        {

            //Blancas

            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {

                  $this->casillas[$i][$j]->cambioOcupada(true, $this->negras[$i][$j]);
                  
                }
            }
            //Negras

            for ($i = count($this->casillas) - 1; $i > count($this->casillas) - 4; $i--) {
                for ($j = 1; $j < count($this->casillas[$i]); $j+2) {
                        $this->casillas[$i][$j]->cambioOcupada(true, $this->blancas[$i][$j]);
                }
            }
        }
        //Pasándole la posición de la casilla inicial y la de final para que haga el movimiento

        function moverPieza($posXIni, $posYIni, $posXFin, $posYFin, $colorTurno)
        {

            $pieza = $this->casillas[$posXIni][$posYIni]->getPieza();
            $this->casillas[$posXIni][$posYIni]->cambioOcupada(null);
            $this->casillas[$posXFin][$posYFin]->cambioOcupada($pieza);
            
            // if (($posXFin == $posXIni + 1 || $posXFin == $posXIni - 1) && ($posYIni == $posYIni + 1)) { //Comprueba el movimiento en la dirección correcta
            //     if (isset($this->casillas[$posXFin][$posYFin])) {       //Comprueba que existe la casilla de destino
            //         if ($this->casillas[$posXFin][$posYFin]['ocupada'] == false) { //Comprueba que la casilla de destino no está ocupada
            //             if ($this->casillas[$posXIni][$posYIni]['ocupada'] === true) {                        //Comprueba que la posición inicial tiene una pieza
            //                 if ($this->casillas[$posXIni][$posYIni]->getPieza()['color'] === $colorTurno) {       //Si la pieza del color es del turno que toca
            //                     
            //                 } else {
            //                     return false;
            //                 }
            //             } else {
            //                 return false;
            //             }
            //         }
            //     }
            // }
        }

        function compruebaTablero()
        { //Para que recorra el tablero mirando si hay que comer obligatoriamente, esto se debería ejecutar al comienzo de cada turno y avisar.

        }

        function comerPieza()
        { //No se si hace falta crear otra función a parte de la de mover para comer

        }

        //Esta función recibe una casilla y si está ocupada mira el color y obtiene la ruta de la imagen

        function muestraImagen($casilla)
        {
            $rutaColor = "";
            $rutaImaBlanca = "./Imagenes/circuloBlanco.svg"; //Ruta a la imagen de la pieza blanca
            $rutaImaNegra = "./Imagenes/circuloNegro.svg"; //ruta a la imagen de la pieza negra

            if ($casilla->getOcupada() == true) {
                if ($casilla->getPieza()->getColor() == 'blanco') {
                    $rutaColor = $rutaImaBlanca;
                } else if ($casilla->getPieza()->getColor() == 'negro') {
                    $rutaColor = $rutaImaNegra;
                }
            }
            return $rutaColor;
        }

        function getColorPieza($posX, $posY)
        {
            return $this->casillas[$posX][$posY]->getPieza()->getColor();
        }
    }

    class Casilla
    {
        private $ocupada;
        private $pieza;
        private $color;

        function __construct()
        {
            $this->ocupada = false;
            $this->pieza = null;
            $this->color = null;
        }

        function getOcupada() //Devuelve si esta ocupada
        {
            return $this->ocupada;
        }

        function cambioOcupada($pieza) //Si se mueve una pieza a la posicion hay un cambio de ocupacion
        { //Set ocupada
            if($pieza != null) {
                $this->ocupada = true;
                $this->pieza = $pieza;
            }else{
                $this->ocupada = false;
                $this->pieza = null;
            }
        }

        function getPieza()
        {
            return $this->pieza;
        }
    }

    class Pieza
    {

        private $posX;
        private $posY;
        private $color;
        private $muerta;

        function __construct($posX, $posY, $color)
        {
            $this->posX = $posX;
            $this->posY = $posY;
            $this->color = $color;
            $this->muerta = false;
        }

        function mueveFicha($nuevaPosX, $nuevaPosY)
        {
            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;
        }

        function getColor()
        {
            return $this->color;
        }

        function muere()
        {
            return $this->muerta = true;
        }

        function getMuerta()
        {
            return $this->muerta;
        }
    }

    function muestraTablero($tablero){

        for ($i = 0; $i < count($tablero->getTablero()); $i++) {
            for ($j = 0; $j < count($tablero->getTablero()[$i]); $j++) {
                echo "<div>";
                if ($tablero->getCasilla($i, $j)->getOcupada() === true) {
                    if (($i + $j) % 2 == 0) {
                        echo "<img class = \"fichas\" src = " . $tablero->muestraImagen($tablero->getCasilla($i, $j)) . " alt = \"No encontre\">";
                    }
                }
                echo "</div>";
            }
            echo "<div class = \"par\"><p> $i </p></div>";
        }
    }

    if (isset($_GET['enviado'])) {
        $posXIni = $_GET['posXInicial'];
        $posYIni = $_GET['posYInicial'];
        $posXFinal = $_GET['posXFinal'];
        $posYFinal = $_GET['posYFinal'];
    }

    

    $colorDelTurno = 'blanco'; //Empiezan las blancas

    $tablero = new Tablero();
    $tablero->construyeTablero();
    $tablero->rellenaTableroDeCasillas();
    $tablero->crearFichas();
    echo '<pre>';
    var_dump($tablero->getPiezas());
    if (isset($_GET['enviado'])) {
       // $tablero->moverPieza(5, );
    }
    echo '</pre>';
    //$tablero->rellenaTableroDeFichas()4;
    if (isset($_GET['enviado'])) {

        //$tablero->moverPieza($posXIni, $posYIni, $posXFinal, $posYFinal, 'blanco');
        echo $posXIni;
        echo $posYIni;
        echo $posXFinal;
        echo $posYFinal;
    }


    $tablero->muestraImagen($tablero->getCasilla(7,2));

    ?>
    <a href="damas.php">Reset</a>
    <pre>
    <?php
    // echo count($tablero->getTablero());
    // var_dump($tablero->getTablero()[7]);
    // $tablero->muestraImagen($tablero->getCasilla(0, 0));
    ?>
</pre>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="posInicial">Posicion inicial</label><br>
        <input type="text" id="posInicial" name="posXInicial" autocomplete="off" placeholder="posX"><br>
        <input type="text" name="posYInicial" autocomplete="off" placeholder="posY"><br><br>
        <label for="posFinal">Posicion final</label><br>
        <input type="text" id="posFinal" name="posXFinal" autocomplete="off" placeholder="posX"><br>
        <input type="text" name="posYFinal"  autocomplete="off" placeholder="posY"><br><br>

        <input type="hidden" name="color" value = "<?php if(isset($_GET['color']))  echo $_GET['color'] ?>" >

        <input type="submit" name="enviado" value="Enviar">
    </form>
    </main>



        <div class="tablero">
            <!-- Aquí van las casillas -->

            <?php

            muestraTablero($tablero);
            
            ?>
        </div>

        <br><br><br><br><br>



</body>

</html>