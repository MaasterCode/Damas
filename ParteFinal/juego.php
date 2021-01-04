<?php
require_once('casillas.php');
require_once('fichas.php');
require_once('tablero.php');
class Juego
{

    public $turno;
    public $resultado;
    public $fin;
    public $tablero;

    function __construct()
    {
        $this->turno = "";
        $this->resultado = "";
        $this->fin = false;
    }

    public function creaTablero()
    {
        $this->tablero = new Tablero();
        $this->tablero->crearFichas();
        $this->tablero->montarTablero();
    }
    public function comienzaJuego()
    {
        $this->creaTablero();
    }

    public function compruebaFichas()
    {

        return false;
    }
    public function sePuedeComer()
    {
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                if (isset($this->tablero->fichas[$i][$j])) {
                $ficha = $this->tablero->fichas[$i][$j];
                if (strcmp($ficha->color, "blanco") === 0) {
                    if (isset($this->tablero->casillas[$i + 1][$j + 1]) && $this->tablero->casillas[$i + 1][$j + 1]->ocupado) {
                        if (strcmp($this->tablero->casillas[$i + 1][$j + 1]->ficha->color, "negro") === 0) {
                            if (isset($this->tablero->casillas[$i + 2][$j + 2]) && $this->tablero->casillas[$i + 2][$j + 2]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                    if (isset($this->tablero->casillas[$i + 1][$j - 1]) && $this->tablero->casillas[$i + 1][$j - 1]->ocupado) {
                        if (strcmp($this->tablero->casillas[$i + 1][$j - 1]->ficha->color, "negro") === 0) {
                            if (isset($this->tablero->casillas[$i + 2][$j - 2]) && $this->tablero->casillas[$i + 2][$j - 2]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                }

                if (strcmp($ficha->color, "negro") === 0) {
                    if (isset($this->tablero->casillas[$i - 1][$j + 1]) && $this->tablero->casillas[$i - 1][$j + 1]->ocupado) {
                        if (strcmp($this->tablero->casillas[$i - 1][$j + 1]->ficha->color, "blanco") === 0) {
                            if (isset($this->tablero->casillas[$i - 2][$j + 2]) && $this->tablero->casillas[$i - 2][$j + 2]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                    if (isset($this->tablero->casillas[$i - 1][$j - 1]) && $this->tablero->casillas[$i - 1][$j - 1]->ocupado) {
                        if (strcmp($this->tablero->casillas[$i - 1][$j - 1]->ficha->color, "blanco") === 0) {
                            if (isset($this->tablero->casillas[$i - 2][$j - 2]) && $this->tablero->casillas[$i - 2][$j - 2]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                }
                }
            }
        }
        return false;
    }
    public function compruebaComer($posXIni, $posYIni, $posXFin, $posYFin)
    {
        //$casillaIni = $this->tablero->casillas[$posXIni][$posYIni];
        //$casillaFin = $this->tablero->casillas[$posXFin][$posYFin];
        $color =  $this->tablero->fichas[$posXIni][$posYIni]->color;

        if (strcmp($color, "blanco") === 0) {
            if ($posXFin - $posXIni == 2 && abs($posYFin - $posYIni) == 2) {
                if ($posYFin > $posYIni) {
                    $posY = $posYFin - 1;
                } else {
                    $posY = $posYFin + 1;
                }
                $posX = $posXFin - 1;
                if ($this->tablero->casillas[$posX][$posY]->ocupado == true) {
                    if (strcmp($this->tablero->casillas[$posX][$posY]->ficha->color, $color) !== 0) {
                        return true;
                    }
                }
            }
        } else if (strcmp($color, "negro") === 0) {
            if ($posXFin - $posXIni == -2 && abs($posYFin - $posYIni) == 2) {
                if ($posYFin > $posYIni) {
                    $posY = $posYFin - 1;
                } else {
                    $posY = $posYFin + 1;
                }
                $posX = $posXFin + 1;
                if ($this->tablero->casillas[$posX][$posY]->ocupado == true) {
                    if (strcmp($this->tablero->casillas[$posX][$posY]->ficha->color, $color) !== 0) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    public function comer($posXIni, $posYIni, $posXFin, $posYFin)
    {
        if ($this->compruebaComer($posXIni, $posYIni, $posXFin, $posYFin)) {
            $this->tablero->comeFicha($posXIni, $posYIni, $posXFin, $posYFin);
        }
    }
    public function elegirFicha()
    {
    }
    public function compruebaMover()
    {

        return false;
    }
    public function mover($posXIni, $posYIni, $posXFin, $posYFin)
    {
        $this->tablero->mueveFicha($posXIni, $posYIni, $posXFin, $posYFin);
    
    }
    public function promocion()
    {
    }

    //jugar() ??
    public function jugar()
    {
    }

    public function dibujaTablero()
    {
        $fichaB = "Imagenes/circuloBlanco.svg";
        $fichaN = "Imagenes/circuloNegro.svg";
?>
        <div class="tableroBox">
            <div class="tablero">
                <?php
                //Hay que definir el tamaño fuera
                $tamaño = 8;
                for ($i = $tamaño; $i >= 1; $i--) {
                    for ($j = 1; $j <= $tamaño; $j++) {
                        if (($j + $i) % 2 == 0) {
                            ?>
                            <div class="casillaN">
                            <?php
                        }
                        if (($j + $i) % 2 != 0) {
                            ?>
                            <div class="casillaB">
                            <?php
                        }
                        if ($this->tablero->casillas[$i][$j]->ocupado) {

                             if (strcmp($this->tablero->fichas[$i][$j]->color, "blanco") === 0) {
                            ?>
                                <img src="<?php echo $fichaB ?>" alt="">
                            <?php
                            }
                            if (strcmp($this->tablero->fichas[$i][$j]->color, "negro") === 0) {
                            ?>
                                <img src="<?php echo $fichaN ?>" alt="">
                            <?php
                            }
                        }
                            ?>
                            <p style = "position: absolute; top: 0; left: 0; color: #FFDEAD; font-size: 25px; z-index: 10;"><?php echo "$i , $j"?></p>
                            </div>
                        <?php
                    }
                }

                ?>
            </div>
        </div>
    <?php
    }
}
