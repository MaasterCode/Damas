<?php
    class Ficha{

        public $posX;
        public $posY;
        public $color;
        public $vivo;
        public $coronado;

        function __construct($i, $j, $color_)
        {
            $this->posX = $i;
            $this->posY = $j;
            $this->color = $color_;
            $this->vivo = true;
            $this->coronado = false;
        }
        public function mueveFicha($nuevaPosX, $nuevaPosY) {
            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;
        }
        public function comeFicha($nuevaPosX, $nuevaPosY) {
            if (strcmp($this->color, "blanco") === 0) {
                $x = $nuevaPosX - 1;
            } else if (strcmp($this->color, "negro") === 0) {
                $x = $nuevaPosX + 1;
            }
           
            if ($nuevaPosY > $this->posY) {
                $y = $nuevaPosY - 1;
            } else {
                $y = $nuevaPosY + 1;
            }

            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;

            if (strcmp($this->color, "negro") === 0) {
                $color = "blanco";
            } else {
                $color = "negro";
            }
            $fichaComida = new Ficha($x, $y, $color);
            return $fichaComida;
        }
        public function cambioEstado() {

        }
        public function cambioCoronado() {

        }
    }
?>