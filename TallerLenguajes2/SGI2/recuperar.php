<?php
    require 'funciones.php';

    $correo = $_POST["correo"];
    echo $correo;
    include_once("db.php");
    $conectar=conn();
    $stmt = mysqli_prepare($conectar, "SELECT * FROM acceso WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $resultado=mysqli_stmt_get_result($stmt) or trigger_error("Error: ",mysqli_error($conectar));
    $total=mysqli_num_rows($resultado);

    if($total>0){
        echo "<br>Usuario y clave correctos";
        $user = getValor("user","email",$correo);

        $token = generaTokenPass($correo);
        $url = "http://" . $_SERVER["SERVER_NAME"] . "/SGI/restablecer.php?user=" . $user . "&token=" . $token;

        $asunto = "Recuperar Contraseña";
        $cuerpo = "Hola $user: <br /><br />Se ha solicitado un reinicio de contraseña <br/><br/>Para restaurar la contraseña visita la siguiente direccion: <a href='$url'>Recuperar Contraseña</a>"; 
        if(enviarCorreo($correo,$user,$asunto,$cuerpo)){
            echo 'Se Envio el Correo';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
        }else{
            echo "Error al enviar";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=recuperar.html'>";
        }
   

    }else{
        echo '<div class="alert alert-warning" role="alert">No se encontro</div>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=recuperar.html'>";
    }
    mysqli_stmt_close($stmt);
?>