<?php

    class Tablero {

        public $casillas;
        public $fichas;

        function __construct()
        {
            $this->casillas = array();
            $this->fichas = array(); //Podemos hacer las fichas separadas por colores
           
        }

        public function crearFichas() {
            //creamos fichas blancas
            for ($i = 1; $i <= 3; $i++) {
                if ($i == 1 || $i == 3) {
                    for ($j = 1; $j <= 7; $j = $j + 2) { 
                        $ficha = new Ficha($i, $j, "blanco");
                        $this->fichas[$i][$j] = $ficha;
                    }
                }
                if ($i == 2) {
                    for ($j = 2; $j <= 8; $j = $j + 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "blanco");
                    }
                }
            }
           
            

            //creamos fichas negras
            for ($i = 8; $i >= 6; $i--) {
                if ($i == 8 || $i == 6) {
                    for ($j = 8; $j >= 2; $j = $j - 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "negro");
                    }
                }
                if ($i == 7) {
                    for ($j = 7; $j >= 1; $j = $j - 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "negro");
                    }
                }
            }
        }

        //Primero crearemos las fichas y luego montamos el tablero

        public function montarTablero(){
            for ($i = 1; $i <= 8; $i++) {
                for ($j = 1; $j <= 8; $j++) {
                    $casilla = new Casilla($i, $j);
                    $this->casillas[$i][$j] = $casilla;
                    if(!empty($this->fichas[$i][$j])){

                        $this->casillas[$i][$j]->cambioOcupado($this->fichas[$i][$j]);
                    }
                }
            }
        }

        //Devuelve false si una casilla está ocuapada

        public function compruebaOcupada($ficha){
            if(strcmp($ficha->posicionX, $this->casilla[$ficha->posicionX]) === 0 && strcmp($ficha->posicionY, $this->casilla[$ficha->posicionY]) === 0){
                return false;
            }else{
                return true;
            }
        }
    }

?>