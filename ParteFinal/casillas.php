<?php
class Casilla
{
    public $ocupado;
    public $ficha;
    public $posicionX; //ej 13 columna 1 fila 3
    public $posicionY;
    function __construct($posX, $posY)
    {
        $this->ocupado = false;
        $this->ficha = null;
        $this->posicionX = $posX;
        $this->posicionY = $posY;
    }

    public function cambioOcupado($ficha)
    {
        if(!empty($ficha)){
            $this->ocupado = true;
            $this->ficha = $ficha;
        }else{
            $this->ocupado = false;
            $this->ficha = null;
        }

    }
    public function compruebaOcupado()
    {

        if ($this->ocupado) {
            return true;
        } else {
            return false;
        }
    }
}
