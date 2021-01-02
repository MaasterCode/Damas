<?php
require_once('casillas.php');
require_once('fichas.php');
require_once('tablero.php');
class Juego
{

    public $turno;
    public $resultado;
    public $fin;

    function __construct()
    {
        $this->turno = "";
        $this->resultado = "";
        $this->fin = false;
    }

    public function creaTablero()
    {
        global $tablero;
        $tablero = new Tablero();
        $tablero->crearFichas();
        $tablero->montarTablero();
    }
    public function comienzaJuego()
    {
        $this->creaTablero();
        $this->dibujaTablero();
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
    public function mover()
    {
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
        global $tablero;
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
                                if ($tablero->casillas[$i][$j]->ocupado) {
                                    if (strcmp($tablero->fichas[$i][$j]->color, "blanco") === 0) {
                                    ?>
                                        <img src="<?php echo $fichaB ?>" alt="">
                                    <?php
                                    }
                                    if (strcmp($tablero->fichas[$i][$j]->color, "negro") === 0) {
                                    ?>
                                        <img src="<?php echo $fichaN ?>" alt="">
                                <?php
                                    }
                                }
                                ?>
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
