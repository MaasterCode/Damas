<div class="tableroBox">
    <div class="tablero">
        <?php
            for ($i = 8; $i >= 1; $i--) {
                for ($j = 1; $j <= 8; $j++) {
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
                    if ($tablero->casillas["$j" . "$i"]->ocupado) {
                        if (strcmp($tablero->casillas["$j" . "$i"]->ficha->color, "blanco") === 0) {
        ?>
                            <img src="<?php echo $fichaB?>" alt="">
        <?php       
                        }
                        if (strcmp($tablero->casillas["$j" . "$i"]->ficha->color, "negro") === 0) {
        ?>              
                            <img src="<?php echo $fichaN?>" alt="">    
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