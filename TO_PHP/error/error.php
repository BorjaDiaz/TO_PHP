<?php 
$status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
    403 => array('403 Forbidden','Acceso denegado'),
    404 => array('404 Not found','Enlace roto, defectuoso o que ya no existe'),
    405 => array('405 Method Not Allowed','El metodo especificado no esta permitido para este recurso'),
    408 => array('408 Request Timeout','Su navegador no pudo enviar una solicitud en el tiempo permitido'),
    500 => array('500 Internal server error','Debido a pronlemas con el servidor no se pudo realizar la solicitud'),
    502 => array('502 Bad gateway','El servidor recibio una respuesta no valida.'),
    504 => array('504 Gateway timeout','No se pudo enviar una solicitud en el tiempo permitido'),
);

$title = $codes[$status][0];
$message = $codes[$status][1];
if($title == false || strlen($status) != 3){
    $message = 'Codigo invalido';
}
?>

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <h3><?php echo $message; ?></h3>

    <div>
<?php
    session_start();
    if(empty($_SESSION['username']) == FALSE){
        echo '<a href="/TO_PHP/src/temas.php">Volver a la pagina de Temas</a>';
    }
    else{
        echo '<a href="/TO_PHP/src/login.php">Volver a la pagina de login</a>';
    }
        
?>
    </div>
</body>
</html>