
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
<?php
class User{
    public $name;
    public $libros;
    function __construct()
    {
        $this->libros = array();
        for($i = 0; $i < 8; $i++){
            array_push($this->libros, $i);
        }
    }
    function cambiarNombre($nombre){
        $this->name = $nombre;
    }

    function cambiarLibros($uno, $dos){
        $aux = $this->libros[$uno];
        $this->libros[$uno] = $this->libros[$dos];
        $this->libros[$dos] = $aux;
    }
}

if(isset($_POST['reset'])){
    session_abort();
    header('Location: pruebaSerializar.php');
}
    session_start();
    var_dump($_SESSION);
    session_abort();
    if(!isset($_SESSION['empieza'])){
        $_SESSION['empieza'] = true;
        
    }
    $user = new User();
    $user->name = 'blah';
    $_SESSION['user'] = $user;
    $GLOBALS['user'] = $user;

    $usuario = $_SESSION['user'];

    $usuario->name = 'jejej';

    $global = $GLOBALS['user'];

    $_SESSION['user'] = $usuario;

    if(isset($_POST['enviado'])){
        $usuario->cambiarLibros($_POST['uno'], $_POST['dos']);
        $_SESSION['user'] = $usuario;

    }
    
    var_dump($_SESSION['user']);
    var_dump($usuario);
   
?>
    </pre>
    <form action="<?php $_SERVER['PHP_SELF']?>" method = "post">
    <input type="text" name = "nombre" placeholder="nombre">
    <input type="number" name="uno" id="">
    <input type="number" name="dos" id="">
    <button name = "reset">"AbortarSesion" </button>
    <input type="submit"  name = "enviado" value = "Enviar">
    </form>
</body>
</html>