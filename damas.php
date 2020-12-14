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
        private $casillas;

        function constructor()
        {
            $this->casillas = array(5);
            foreach ($this->casillas as $casilla) {
                $casilla = array(5);
            }
        }

        function rellenaTableroDeCasillas()
        {
            for ($i = 0; $i < count($this->casillas); $i++) {
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    $this->casillas[$i][$j] = new Casilla($i, $j);
                }
            }
        }

        function rellenaTableroDeFichas(){ //Esto iría después de rellenar de casillas para rellenar INICIALMENTE de piezas en su sitio.
            $ponerFicha = 0; //Esta variable es para hacerle el módulo y que alterne entre poner y no poner

            //Blancas

            for ($i = 0; $i < 1 ; $i++) { //Por ahora pongo uno porque no es el tablero completo
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    if($ponerFicha % 2 == 0){
                        $this->casillas[$i][$j]['pieza'] = new Pieza($i , $j, 'blanco');
                    }
                    ++$ponerFicha;
                }
            }

            $ponerFicha = 0;

            //Negras

            for ($i = count($this->casillas); $i > count($this->casillas)-1 ; $i--) { //Por ahora pongo uno porque no es el tablero completo
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    if($ponerFicha % 2 == 0){
                        $this->casillas[$i][$j]['pieza'] = new Pieza($i , $j, 'negro');
                    }
                    ++$ponerFicha;
                }
            }

            //Poner imagen a todas

            for ($i = 0; $i < count($this->casillas); $i++) {
                for ($j = 0; $j < count($this->casillas[$i]); $j++) {
                    $this->muestraImagen($i, $j);
                }
            }
        }

        function moverPieza($posXIni, $posYIni, $posXFin, $posYFin, $colorTurno){
    
            if(($posXIni == $posXIni + 1 || $posXIni ==$posXIni -1) && ($posYIni == $posYIni + 1)){ //Comprueba el movimiento en la dirección correcta
                if($this->casillas[$posXIni][$posYIni]['ocupada'] === true){                        //Comprueba que la posición inicial tiene una pieza
                    if($this->casillas[$posXIni][$posYIni]['ocupada']['color'] === $colorTurno){       //Si la pieza del color es del turno que toca
                        //Comprobar que la casilla a la que va, está ocupada
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }

        function compruebaTablero(){ //Para que recorra el tablero mirando si hay que comer obligatoriamente, esto se debería ejecutar al comienzo de cada turno y avisar.

        }

        function comerPieza(){ //No se si hace falta crear otra función a parte de la de mover para comer

        }

        function muestraImagen($posX, $posY){
            $rutaColor = "";
            $rutaImaBlanca = "./Imagenes/CirculoBlanco"; //Ruta a la imagen de la pieza blanca
            $rutaImaNegra = "./Imagenes/CirculoNegro"; //ruta a la imagen de la pieza negra
        
            if($this->casillas[$posX][$posY]['ocupada'] == true){
                if($this->casillas[$posX][$posY]['pieza']['color'] == 'blanco'){
                    $rutaColor = $rutaImaBlanca;
                }else if($this->casillas[$posX][$posY]['pieza']['color'] == 'negro'){
                    $rutaColor = $rutaImaNegra;
                }
            }

            echo '<img class="fichas" src="'.$rutaColor.'">';
        }
    }

    class Casilla
    {


        private $posX;
        private $posY;
        private $ocupada;
        private $pieza;
    

        function constructor($posX, $posY)
        {
            $this->posX = $posX;
            $this->posY = $posY;
            $this->ocupada = false;
            $this->pieza = null;
        }

        function getOcupada()
        {
            return $this->ocupada;
        }

        function cambioOcupada($cambio, $pieza) //Si se mueve una pieza a la posicion hay un cambio de ocupacion
        { //Set ocupada
            $this->ocupada = $cambio;
            $this->pieza = $pieza;
        }

    }

    class Pieza
    {

        private $posX;
        private $posY;
        private $color;
        private $muerta;

        function constructor($posX, $posY, $color)
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
    $tablero->rellenaTableroDeCasillas();
    $tablero->rellenaTableroDeFichas();
    ?>

    <main>
        <div class="tablero">
            <div class="casilla2"><?php ponerImagen(); ?></div>
            <div class="casilla1"><?php ponerImagen(); ?></div>
            <div class="casilla3"><?php ponerImagen(); ?></div>
            <div class="casilla4"><?php ponerImagen(); ?></div>
            <div class="casilla5"><?php ponerImagen(); ?></div>
            <div class="casilla6"><?php ponerImagen(); ?></div>
            <div class="casilla7"><?php ponerImagen(); ?></div>
            <div class="casilla8"><?php ponerImagen(); ?></div>
            <div class="casilla9"><?php ponerImagen(); ?></div>
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