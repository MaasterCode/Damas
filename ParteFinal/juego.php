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
    public function compruebaComer()
    {

        return false;
    }
    public function comer()
    {
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
