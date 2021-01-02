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
        public function comeFicha() {

        }
        public function cambioEstado() {

        }
        public function cambioCoronado() {

        }
    }
?>