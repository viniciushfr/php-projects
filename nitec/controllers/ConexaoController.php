<?php
function conectarAoBanco(){
    $servidor = 'localhost';
    $usuario = 'viniciushfr';
    $senha = '';
    $banco = 'nitec';

    $mysqli = new mysqli($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno()) {
        return trigger_error(mysqli_connect_error());
    }else{
        return $mysqli;
    }
    
    }

?>    