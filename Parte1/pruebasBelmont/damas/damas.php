<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damas</title>
    <meta name="author" content="">
    <meta name="description" content="">
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
        img {
            display: block;
            width: 65px;
            height: 65px;
            z-index: 20;
        }
    </style>
    <?php
        class Tablero {
            public $casillas = array();
            public $fichas = array();

            public function crearFichas() {
                //creamos fichas blancas
                for ($i = 1; $i <= 3; $i++) {
                    if ($i == 1 || $i == 3) {
                        for ($j = 1; $j <= 7; $j = $j + 2) {
                            $ficha = new Ficha();
                            $ficha->posicionX = "$j";
                            $ficha->posicionY = "$i";
                            $ficha->color = "blanco";
                            $ficha->vivo = true;
                            $ficha->coronado = false;
                            $this->fichas[] = $ficha;
                        }
                    }
                    if ($i == 2) {
                        for ($j = 2; $j <= 8; $j = $j + 2) {
                            $ficha = new Ficha();
                            $ficha->posicionX = "$j";
                            $ficha->posicionY = "$i";
                            $ficha->color = "blanco";
                            $ficha->vivo = true;
                            $ficha->coronado = false;
                            $this->fichas[] = $ficha;
                        }
                    }
                }

                //creamos fichas negras
                for ($i = 8; $i >= 6; $i--) {
                    if ($i == 8 || $i == 6) {
                        for ($j = 8; $j >= 2; $j = $j - 2) {
                            $ficha = new Ficha();
                            $ficha->posicionX = "$j";
                            $ficha->posicionY = "$i";
                            $ficha->color = "negro";
                            $ficha->vivo = true;
                            $ficha->coronado = false;
                            $this->fichas[] = $ficha;
                        }
                    }
                    if ($i == 7) {
                        for ($j = 7; $j >= 1; $j = $j - 2) {
                            $ficha = new Ficha();
                            $ficha->posicionX = "$j";
                            $ficha->posicionY = "$i";  
                            $ficha->color = "negro";
                            $ficha->vivo = true;
                            $ficha->coronado = false;
                            $this->fichas[] = $ficha;
                        }
                    }
                }
            }
            public function montarTablero() {
                for ($i = 1; $i <= 8; $i++) {
                    for ($j = 1; $j <= 8; $j++) {
                        $casilla = new Casilla();
                        $casilla->posicionX = "$j";
                        $casilla->posicionY = "$i";
                        $casilla->compruebaOcupado($this->fichas);
                        $this->casillas["$j" . "$i"] = $casilla;
                    }
                }
            }
        }

        class Casilla {
            public $ocupado = false;
            public $ficha = null;
            public $posicionX = ""; //ej 13 columna 1 fila 3
            public $posicionY = "";

            public function cambioOcupado() {

            }
            public function compruebaOcupado($fichas) {
                foreach ($fichas as $ficha) {
                    if ((strcmp($ficha->posicionX, $this->posicionX) === 0) && (strcmp($ficha->posicionY, $this->posicionY) === 0)) {
                        $this->ocupado = true;
                        $this->ficha = $ficha;
                        break; 
                    }
                }
            }
        }

        class Ficha {
            public $posicionX = ""; //ej 13 columna 1 fila 3
            public $posicionY = "";
            public $color = "";
            public $vivo = false;
            public $coronado = false;

            public function mueveFicha() {

            }
            public function comeFicha() {

            }
            public function cambioEstado() {

            }
            public function cambioCoronado() {

            }
        }

        //posible clase Juego???
        class Juego {
            public $turno = "";
            public $resultado = "";
            public $fin = false;

            public function compruebaFichas() {
                
                return false;
            }
            public function compruebaComer() {

                return false;
            }
            public function comer() {

            }
            public function elegirFicha() {

            }
            public function compruebaMover() {

                return false;
            }
            public function mover() {

            }
            public function promocion() {

            }

            //jugar() ??
            public function jugar() {

            }
        }

        //...
        $fichaB = "Imagenes/circuloBlanco.svg";
        $fichaN = "Imagenes/circuloNegro.svg";

        $tablero = new Tablero();
        $tablero->crearFichas();
        $tablero->montarTablero();
    ?>
</head>

<body>
    <?php
        include_once "tableroPrueba.php";
    ?>
</body>

</html>