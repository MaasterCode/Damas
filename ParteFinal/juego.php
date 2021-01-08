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
    public $errores;
    public $numBlancas;
    public $numNegras;

    function __construct()
    {
        $this->turno = "blanco";
        $this->resultado = "";
        $this->fin = false;
        $this->errores = array();
        $this->numBlancas = 0;
        $this->numNegras = 0;
    }

    public function comienzaJuego()
    {
        $this->tablero = new Tablero();
        $this->tablero->crearFichas();
        $this->tablero->montarTablero();
    }

    public function sePuedeComer()
    {
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                if (isset($this->tablero->fichas[$i][$j]) && strcmp($this->tablero->fichas[$i][$j]->color, $this->turno) === 0) {
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

    public function puedeSeguirComendo($posX, $posY)
    {
        $color = $this->tablero->fichas[$posX][$posY]->color;

        if (strcmp($color, "blanco") === 0) {
            if (isset($this->tablero->casillas[$posX + 1][$posY + 1]) && $this->tablero->casillas[$posX + 1][$posY + 1]->ocupado) {
                if (strcmp($this->tablero->fichas[$posX + 1][$posY + 1]->color, "negro") === 0) {
                    if (isset($this->tablero->casillas[$posX + 2][$posY + 2]) && $this->tablero->casillas[$posX + 2][$posY + 2]->ocupado == false) {
                        return true;
                    }
                }
            }
            if (isset($this->tablero->casillas[$posX + 1][$posY - 1]) && $this->tablero->casillas[$posX + 1][$posY - 1]->ocupado) {
                if (strcmp($this->tablero->fichas[$posX + 1][$posY - 1]->color, "negro") === 0) {
                    if (isset($this->tablero->casillas[$posX + 2][$posY - 2]) && $this->tablero->casillas[$posX + 2][$posY - 2]->ocupado == false) {
                        return true;
                    }
                }
            }
        }

        if (strcmp($color, "negro") === 0) {
            if (isset($this->tablero->casillas[$posX - 1][$posY + 1]) && $this->tablero->casillas[$posX - 1][$posY + 1]->ocupado) {
                if (strcmp($this->tablero->fichas[$posX - 1][$posY + 1]->color, "blanco") === 0) {
                    if (isset($this->tablero->casillas[$posX - 2][$posY + 2]) && $this->tablero->casillas[$posX - 2][$posY + 2]->ocupado == false) {
                        return true;
                    }
                }
            }
            if (isset($this->tablero->casillas[$posX - 1][$posY - 1]) && $this->tablero->casillas[$posX - 1][$posY - 1]->ocupado) {
                if (strcmp($this->tablero->fichas[$posX - 1][$posY - 1]->color, "blanco") === 0) {
                    if (isset($this->tablero->casillas[$posX - 2][$posY - 2]) && $this->tablero->casillas[$posX - 2][$posY - 2]->ocupado == false) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    function comprobarFichas()
    {
        $this->numBlancas = 0;
        $this->numNegras = 0;
        foreach ($this->tablero->fichas as $fila) {
            foreach ($fila as $ficha) {
                if (isset($ficha)) {
                    if (strcmp($ficha->color, 'blanco') === 0) {
                        $this->numBlancas++;
                    } else if (strcmp($ficha->color, 'negro') === 0) {
                        $this->numNegras++;
                    }
                }
            }
        }
        if ($this->numNegras < 1 || $this->numBlancas < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function compruebaComer($posXIni, $posYIni, $posXFin, $posYFin)
    {
        //$casillaIni = $this->tablero->casillas[$posXIni][$posYIni];
        //$casillaFin = $this->tablero->casillas[$posXFin][$posYFin];
        $color =  $this->tablero->fichas[$posXIni][$posYIni]->color;

        if (strcmp($color, "blanco") === 0 && strcmp($this->tablero->fichas[$posXIni][$posYIni]->color, $this->turno) === 0) {
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
        } else if (strcmp($color, "negro") === 0 && strcmp($this->tablero->fichas[$posXIni][$posYIni]->color, $this->turno) === 0) {
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
            if (!$this->puedeSeguirComendo($posXFin, $posYFin)) {
                $this->cambioTurno();
            }
        }
    }
    public function elegirFicha()
    {
    }
    function compruebaMover($posXIni, $posYIni, $posXFin, $posYFin)
    {
        $this->errores = array();
        if (isset($this->tablero->fichas[$posXIni][$posYIni])) {
            if (isset($this->tablero->casillas[$posXFin][$posYFin])) { //Comprueba si la casilla final existe
                if (strcmp($this->tablero->fichas[$posXIni][$posYIni]->color, $this->turno) === 0) { //Que el color sea el del turno       
                    $color = $this->tablero->fichas[$posXIni][$posYIni]->color;
                    if (strcmp($this->turno, "blanco") === 0) { //Si el turno es del blanco...
                        if (($posYFin == $posYIni + 1 || $posYFin == $posYIni - 1) && $posXFin == $posXIni + 1) { //....comprueba que mueva hacia arriba y alguno de los lados  
                            if ($this->tablero->casillas[$posXFin][$posYFin]->ocupado == false) {
                                //Y aquí acaba, si no ha habido errores abajo retorna true;
                            } else {
                                array_push($this->errores, "La casilla destino está ocupada");
                            }
                        } else {
                            array_push($this->errores, "La dirección del movimiento no es correcto, las blancas mueve hacia arriba y a los lados una unidad");
                        }
                    } else if (strcmp($this->turno, "negro") === 0) { //Si el turno es del negro....
                        if (($posYIni + 1 == $posYFin || $posYIni - 1 == $posYFin) && ($posXIni - 1 == $posXFin)) { //....comprueba que mueva hacia abajo y alguno de los lados

                            if ($this->tablero->casillas[$posXFin][$posYFin]->ocupado == false) {
                                //Y aquí acaba, si no ha habido errores abajo retorna true;
                            } else {
                                array_push($this->errores, "La casilla destino está ocupada");
                            }
                        } else {
                            array_push($this->errores, "La dirección del movimiento no es correcto, las negras mueve hacia arriba y a los lados una unidad");
                        }
                    } else {
                        array_push($this->errores, "El color no coincide con el del turno" . $color . '<br>' . $this->turno);
                    }
                } else {
                    array_push($this->errores, "La ficha no es de tu color, le toca al " . $this->turno);
                }
            } else {
                array_push($this->errores, "La casilla final no existe");
            }
        }else{
            array_push($this->errores, "La ficha no existe");
        }

        if (count($this->errores) > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function mover($posXIni, $posYIni, $posXFin, $posYFin)
    {
        if ($this->compruebaMover($posXIni, $posYIni, $posXFin, $posYFin)) {
            $this->tablero->mueveFicha($posXIni, $posYIni, $posXFin, $posYFin);
            $this->cambioTurno();
        }
    }
    public function cambioTurno()
    {
        if ($this->turno == "blanco") {
            $this->turno = "negro";
        } else if ($this->turno == "negro") {
            $this->turno = "blanco";
        }
    }
    public function mostrarErrores()
    {
        foreach ($this->errores as $error) {
            echo $error . "<br>";
        }
    }

    public function promocion()
    {
        echo "hola";
        for($j = 1; $j <= 7; $j + 2){
            if(isset($this->tablero->fichas[1][$j])){
                if(strcmp($this->tablero->fichas[1][$j]->color, "negro") === 0){
                    $this->tablero->fichas[1][$j]->cambioCoronado();
                    echo "coronadoNegras";
                }
            }
            
        }
        for($j = 2; $j <= 8; $j + 2){
            if(isset($this->tablero->fichas[8][$j])){
                if(strcmp($this->tablero->fichas[8][$j]->color, "blanco") === 0){
                    $this->tablero->fichas[8][$j]->cambioCoronado();
                    echo "coronadoBlancas";
                }
            }
            
        }
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
                            <p><?php echo "$i,$j" ?></p>
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
