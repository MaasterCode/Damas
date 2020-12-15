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
            grid-template-columns: 1fr 1fr 1fr;
            grid-auto-rows: 1fr;
            width: 500px;
            height: 500px;
        }

        .tablero div {
            border: 1px solid black;
        }

        .tabalero:nth-child(odd) {
            background: black;
        }

        .tablero:nth-child(even) {
            background: white;
        }
    </style>
</head>

<body>

    <?php

    class Tablero
    {
        public $casillas;

        function __construct()
        {
            $this->casillas = array();
            $this->casillas = array_fill(0, 5, array());
        }

        function construyeTablero()
        {
            $this->casillas[0] = array_fill(0, 3, array());
            $this->casillas[1] = array_fill(0, 3, array());
            $this->casillas[2] = array_fill(0, 3, array());
        }

        function getTablero()
        {
            return $this->casillas;
        }

        function getCasilla($posX, $posY)
        {
            return $this->casillas[$posX][$posY];
        }

        function rellenaTableroDeCasillas()
        {
            for ($i = 0; $i < count($this->casillas); $i++) {
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    $this->casillas[$i][$j] = new Casilla($i, $j);
                }
            }
        }

        function rellenaTableroDeFichas()
        { //Esto iría después de rellenar de casillas para rellenar INICIALMENTE de piezas en su sitio.
            $ponerFicha = true; //Esta variable es para hacerle el módulo y que alterne entre poner y no poner

            //Blancas

            for ($i = 0; $i < count($this->casillas); $i++) { //Por ahora pongo uno porque no es el tablero completo
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {

                    $this->casillas[$i][$j]->cambioOcupada(true, new Pieza($i, $j, 'blanco'));
                }
            }

            $ponerFicha = true;

            //Negras

            // for ($i = count($this->casillas); $i > count($this->casillas) - 1; $i--) { //Por ahora pongo uno porque no es el tablero completo
            //     for ($j = 0; $j < count($this->casillas[$i]); $j++) {
            //         if ($ponerFicha % 2 == 0) {
            //             $this->casillas[$i][$j]['pieza'] = new Pieza($i, $j, 'negro');
            //         }
            //         ++$ponerFicha;
            //     }
            // }


        }
        function moverPieza($posXIni, $posYIni, $posXFin, $posYFin, $colorTurno)
        {

            if (($posXIni == $posXIni + 1 || $posXIni == $posXIni - 1) && ($posYIni == $posYIni + 1)) { //Comprueba el movimiento en la dirección correcta
                if ($this->casillas[$posXIni][$posYIni]['ocupada'] === true) {                        //Comprueba que la posición inicial tiene una pieza
                    if ($this->casillas[$posXIni][$posYIni]['ocupada']['color'] === $colorTurno) {       //Si la pieza del color es del turno que toca
                        //Comprobar que la casilla a la que va, está ocupada
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        function compruebaTablero()
        { //Para que recorra el tablero mirando si hay que comer obligatoriamente, esto se debería ejecutar al comienzo de cada turno y avisar.

        }

        function comerPieza()
        { //No se si hace falta crear otra función a parte de la de mover para comer

        }

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


        public $posX;
        public $posY;
        public $ocupada;
        public $pieza;


        function __construct($posX, $posY)
        {
            $this->posX = $posX;
            $this->posY = $posY;
            $this->ocupada = false;
            $this->pieza = null;
        }

        function getOcupada() //Devuelve si esta ocupada
        {
            return $this->ocupada;
        }

        function cambioOcupada($cambio, $pieza) //Si se mueve una pieza a la posicion hay un cambio de ocupacion
        { //Set ocupada
            $this->ocupada = $cambio;
            $this->pieza = $pieza;
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

    if (isset($_GET['enviado'])) {
        $posXIni = $_GET['posXInicial'];
        $posYIni = $_GET['posYInicial'];
        $posXFinal = $_GET['posXFinal'];
        $posYFinal = $_GET['posYFinal'];
    }

    $tablero = new Tablero();
    $tablero->construyeTablero();
    $tablero->rellenaTableroDeCasillas();
    $tablero->rellenaTableroDeFichas();


    ?>
    <pre>
    <?php
    var_dump($tablero->getCasilla(0, 2));
    var_dump($tablero->getTablero());
    // $tablero->muestraImagen($tablero->getCasilla(0, 0));
    ?>
</pre>


    <main>
        <div class="tablero">
            <!-- Aquí van las casillas -->

            <div>
                <!-- 0 , 0  -->
                <img class="fichas" src="<?php echo $tablero->muestraImagen($tablero->getCasilla(0, 0)) ?>" alt="No encontre">

            </div>
            <div>


            </div>
            <div>

                <img class="fichas" src="<?php echo $tablero->muestraImagen($tablero->getCasilla(0, 2)) ?>" alt="No encontre">


            </div>
            <div>


            </div>
            <div>

                <img class="fichas" src="<?php echo $tablero->muestraImagen($tablero->getCasilla(0, 2)) ?>" alt="No encontre">

            </div>
            <div>



            </div>
            <div>

                <img class="fichas" src="<?php echo $tablero->muestraImagen($tablero->getCasilla(0, 2)) ?>" alt="No encontre">


            </div>


            <div></div>
            <div>

                <img class="fichas" src="<?php echo $tablero->muestraImagen($tablero->getCasilla(0, 2)) ?>" alt="No encontre">


            </div>
        </div>


        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="posXInicial">
            <input type="text" name="posYInicial">

            <input type="text" name="posXFinal">
            <input type="text" name="posYFinal">

            <input type="submit" name="enviado" value="Enviar">
        </form>
    </main>


</body>

</html>