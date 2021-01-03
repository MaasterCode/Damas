<?php
class Tablero{
    function compruebaMover($posXIni, $posYIni, $posXFin, $posYFin){
        global $errores, $turno;
        $errores = array();
        if(isset($this->tablero->casillas[$posXFin][$posYFin])){ //Comprueba si la casilla final existe
            if(strcmp($this->tablero->piezas[$posXIni][$posYIni]->color, $turno) === 0){ //Que el color sea el del turno
                if(strcmp($this->tablero->casillas[$posXFin][$posYFin]->color, "negro")=== 0){ //Que la casilla destino sea del color negro, las casillas blancas no se usan
                    
                    if(strcmp($turno, "blanco")){ //Si el turno es del blanco...

                        if( ($posXIni+1 == $posXFin || $posXIni-1 == $posXFin) && ($posYIni+1 == $posYFin)){ //....comprueba que mueva hacia arriba y alguno de los lados

                            if($this->tablero->casilla[$posXFin][$posYFin]->ocupada == false){
                                //Y aquí acaba, si no ha habido errores abajo retorna true;
                            }else{
                                array_push($errores, "La casilla destino está ocupada");
                            }
                        }else{
                            array_push($errores, "La dirección del movimiento no es correcto, las blancas mueve hacia arriba y a los lados una unidad");
                        }

                        
                    }else if(strcmp($turno, "negro")){ //Si el turno es del negro....

                        if( ($posXIni+1 == $posXFin || $posXIni-1 == $posXFin) && ($posYIni-1 == $posYFin)){ //....comprueba que mueva hacia abajo y alguno de los lados

                            if($this->tablero->casilla[$posXFin][$posYFin]->ocupada == false){
                                //Y aquí acaba, si no ha habido errores abajo retorna true;
                            }else{
                                array_push($errores, "La casilla destino está ocupada");
                            }
                        }else{
                            array_push($errores, "La dirección del movimiento no es correcto, las blancas mueve hacia arriba y a los lados una unidad");
                        }
                    }

                }else{
                    array_push($errores, "La casilla no es del color que corresponde");
                }
            }else{
                array_push($errores, "La ficha no es de tu color, le toca al ".$turno);
            }
        }else{
            array_push($errores, "La casilla final no existe");
        }
        
        if(count($errores) > 0){
            return false;
        }else{
            return true;
        }
    }
}
?>