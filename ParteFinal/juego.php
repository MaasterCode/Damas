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
                if (isset($this->tablero->fichas[$i][$j]) && strcmp($this->tablero->fichas[$i][$j]->color, $this->turno) === 0 && $this->tablero->fichas[$i][$j]->coronado == false) {
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
                } else if (isset($this->tablero->fichas[$i][$j]) && strcmp($this->tablero->fichas[$i][$j]->color, $this->turno) === 0 && $this->tablero->fichas[$i][$j]->coronado) {
                    $ficha = $this->tablero->fichas[$i][$j];
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->casillas[$i + $x][$j + $y])) {
                            if ($this->tablero->casillas[$i + $x][$j + $y]->ocupado) {
                                if (strcmp($this->tablero->casillas[$i + $x][$j + $y]->ficha->color, $ficha->color) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->casillas[$i + $x][$j + $y]->ficha->color, $ficha->color) !== 0) {
                                    if (isset($this->tablero->casillas[$i + $x + 1][$j + $y + 1]) && $this->tablero->casillas[$i + $x + 1][$j + $y + 1]->ocupado == false) {
                                        return true;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->casillas[$i + $x][$j - $y])) {
                            if ($this->tablero->casillas[$i + $x][$j - $y]->ocupado) {
                                if (strcmp($this->tablero->casillas[$i + $x][$j - $y]->ficha->color, $ficha->color) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->casillas[$i + $x][$j - $y]->ficha->color, $ficha->color) !== 0) {
                                    if (isset($this->tablero->casillas[$i + $x + 1][$j - $y - 1]) && $this->tablero->casillas[$i + $x + 1][$j - $y - 1]->ocupado == false) {
                                        return true;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->casillas[$i - $x][$j + $y])) {
                            if ($this->tablero->casillas[$i - $x][$j + $y]->ocupado) {
                                if (strcmp($this->tablero->casillas[$i - $x][$j + $y]->ficha->color, $ficha->color) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->casillas[$i - $x][$j + $y]->ficha->color, $ficha->color) !== 0) {
                                    if (isset($this->tablero->casillas[$i - $x - 1][$j + $y + 1]) && $this->tablero->casillas[$i - $x - 1][$j + $y + 1]->ocupado == false) {
                                        return true;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->casillas[$i - $x][$j - $y])) {
                            if ($this->tablero->casillas[$i - $x][$j - $y]->ocupado) {
                                if (strcmp($this->tablero->casillas[$i - $x][$j - $y]->ficha->color, $ficha->color) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->casillas[$i - $x][$j - $y]->ficha->color, $ficha->color) !== 0) {
                                    if (isset($this->tablero->casillas[$i - $x - 1][$j - $y - 1]) && $this->tablero->casillas[$i - $x - 1][$j - $y - 1]->ocupado == false) {
                                        return true;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                }
            }
        }
        return false;
    }

    public function puedeSeguirComendo($posX, $posY)
    {
        $color = $this->tablero->fichas[$posX][$posY]->color;

        if ($this->tablero->fichas[$posX][$posY]->coronado == false) {

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
        } else if ($this->tablero->fichas[$posX][$posY]->coronado) {
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->casillas[$posX + $x][$posY + $y])) {
                    if ($this->tablero->casillas[$posX + $x][$posY + $y]->ocupado) {
                        if (strcmp($this->tablero->casillas[$posX + $x][$posY + $y]->ficha->color, $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->casillas[$posX + $x][$posY + $y]->ficha->color, $color) !== 0) {
                            if (isset($this->tablero->casillas[$posX + $x + 1][$posY + $y + 1]) && $this->tablero->casillas[$posX + $x + 1][$posY + $y + 1]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->casillas[$posX + $x][$posY - $y])) {
                    if ($this->tablero->casillas[$posX + $x][$posY - $y]->ocupado) {
                        if (strcmp($this->tablero->casillas[$posX + $x][$posY - $y]->ficha->color, $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->casillas[$posX + $x][$posY - $y]->ficha->color, $color) !== 0) {
                            if (isset($this->tablero->casillas[$posX + $x + 1][$posY - $y - 1]) && $this->tablero->casillas[$posX + $x + 1][$posY - $y - 1]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->casillas[$posX - $x][$posY + $y])) {
                    if ($this->tablero->casillas[$posX - $x][$posY + $y]->ocupado) {
                        if (strcmp($this->tablero->casillas[$posX - $x][$posY + $y]->ficha->color, $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->casillas[$posX - $x][$posY + $y]->ficha->color, $color) !== 0) {
                            if (isset($this->tablero->casillas[$posX - $x - 1][$posY + $y + 1]) && $this->tablero->casillas[$posX - $x - 1][$posY + $y + 1]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->casillas[$posX - $x][$posY - $y])) {
                    if ($this->tablero->casillas[$posX - $x][$posY - $y]->ocupado) {
                        if (strcmp($this->tablero->casillas[$posX - $x][$posY - $y]->ficha->color, $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->casillas[$posX - $x][$posY - $y]->ficha->color, $color) !== 0) {
                            if (isset($this->tablero->casillas[$posX - $x - 1][$posY - $y - 1]) && $this->tablero->casillas[$posX - $x - 1][$posY - $y - 1]->ocupado == false) {
                                return true;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
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
        if (isset($this->tablero->fichas[$posXIni][$posYIni])) {
            $color =  $this->tablero->fichas[$posXIni][$posYIni]->color;

            if ($this->tablero->fichas[$posXIni][$posYIni]->coronado == false) {
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
            } else if ($this->tablero->fichas[$posXIni][$posYIni]->coronado) {
                $cont = 0;
                if (abs($posXFin - $posXIni) == abs($posYFin - $posYIni)) {
                    if (isset($this->tablero->casillas[$posXFin][$posYFin]) && $this->tablero->casillas[$posXFin][$posYFin]->ocupado == false) {
                        if ($posYFin - $posYIni > 0) {
                            $suma = 1;
                        } else if ($posYFin - $posYIni < 0) {
                            $suma = -1;
                        }

                        if ($posXFin - $posXIni > 0) {
                            $j = $posYIni;
                            for ($i = $posXIni + 1; $i < $posXFin; $i++) {
                                $j += $suma;
                                if (isset($this->tablero->casillas[$i][$j]) && $this->tablero->casillas[$i][$j]->ocupado) {
                                    if (strcmp($this->turno, $this->tablero->casillas[$i][$j]->ficha->color) === 0) {
                                        return false;
                                    } else if (strcmp($this->turno, $this->tablero->casillas[$i][$j]->ficha->color) !== 0) {
                                        $cont++;
                                    }
                                }
                            }
                        }

                        if ($posXFin - $posXIni < 0) {
                            $j = $posYIni;
                            for ($i = $posXIni - 1; $i > $posXFin; $i--) {
                                $j += $suma;
                                if (isset($this->tablero->casillas[$i][$j]) && $this->tablero->casillas[$i][$j]->ocupado) {
                                    if (strcmp($this->turno, $this->tablero->casillas[$i][$j]->ficha->color) === 0) {
                                        return false;
                                    } else if (strcmp($this->turno, $this->tablero->casillas[$i][$j]->ficha->color) !== 0) {
                                        $cont++;
                                    }
                                }
                            }
                        }
                    }
                    if ($cont === 1) {
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
            $this->tablero->comeFicha($posXIni, $posYIni, $posXFin, $posYFin, $this->tablero);
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

                    if ($this->tablero->fichas[$posXIni][$posYIni]->coronado == false) { //Si no está coronado

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
                                array_push($this->errores, "La dirección del movimiento no es correcto, las negras mueven hacia abajo y a los lados una unidad");
                            }
                        } else {
                            array_push($this->errores, "El color no coincide con el del turno" . $this->turno . '<br>');
                        }
                    } else if ($this->tablero->fichas[$posXIni][$posYIni]->coronado == true) { //Si está coronado
                        if (abs($posYIni - $posYFin) == abs($posXIni - $posXFin) && $posXIni - $posXFin != 0 && $posYIni - $posYFin != 0) { //Comprueba que se avanza lo mismo en vertical que en horizontal
                            //Mira la direccion del desplazamiento

                            if ($posXIni - $posXFin < 0) {  //Arriba

                                if ($posYIni - $posYFin > 0) {
                                    $suma = -1;
                                } else if ($posYIni - $posYFin < 0) {
                                    $suma = 1;
                                }
                                for ($i = $posXIni + 1; $i < $posXFin; $i++) {
                                    $posYIni += $suma;
                                    if (isset($this->tablero->casillas[$i][$posYIni]) && $this->tablero->casillas[$i][$posYIni]->ocupado == false) {
                                    } else if ($this->tablero->casillas[$i][$posYIni]->ocupado == true) {
                                        array_push($this->errores, "Hay una pieza delante");
                                        break;
                                    }
                                }
                            } else if ($posXIni - $posXFin > 0) {  //Abajo

                                if ($posYIni - $posYFin > 0) {
                                    $suma = -1;
                                } else if ($posYIni - $posYFin < 0) {
                                    $suma = 1;
                                }
                                for ($i = $posXIni - 1; $i > $posXFin; $i--) {
                                    $posYIni += $suma;
                                    if (isset($this->tablero->casillas[$i][$posYIni]) && $this->tablero->casillas[$i][$posYIni]->ocupado == false) {
                                    } else if ($this->tablero->casillas[$i][$posYIni]->ocupado == true) {
                                        array_push($this->errores, "Hay una pieza delante");
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    array_push($this->errores, "La ficha no es de tu color, le toca al " . $this->turno);
                }
            } else {
                array_push($this->errores, "La casilla final no existe");
            }
        } else {
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
        for ($j = 1; $j <= 7; $j += 2) {
            if (isset($this->tablero->fichas[1][$j])) {
                if (strcmp($this->tablero->fichas[1][$j]->color, "negro") === 0) {
                    $this->tablero->fichas[1][$j]->cambioCoronado();
                }
            }
        }
        for ($j = 2; $j <= 8; $j += 2) {
            if (isset($this->tablero->fichas[8][$j])) {
                if (strcmp($this->tablero->fichas[8][$j]->color, "blanco") === 0) {
                    $this->tablero->fichas[8][$j]->cambioCoronado();
                }
            }
        }
    }

    public function dibujaTablero()
    {
        $fichaB = "Imagenes/FichaBlanca.svg";
        $fichaN = "Imagenes/FichaNegra.svg";
        $reinaB = "Imagenes/ReinaBlanca.svg";
        $reinaN = "Imagenes/ReinaNegra.svg";
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
                                    if ($this->tablero->fichas[$i][$j]->coronado == false) {

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
                                    } else if ($this->tablero->fichas[$i][$j]->coronado == true) {

                                        if (strcmp($this->tablero->fichas[$i][$j]->color, "blanco") === 0) {
                                        ?>
                                            <img src="<?php echo $reinaB ?>" alt="">
                                        <?php
                                        }
                                        if (strcmp($this->tablero->fichas[$i][$j]->color, "negro") === 0) {
                                        ?>
                                            <img src="<?php echo $reinaN ?>" alt="">
                                <?php
                                        }
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
