<?php
session_start();
require 'funciones.php';
include_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST["user"];
    $clave = $_POST["pass"];
    echo "Password123@";

    $pass = encriptar($clave);
    echo $pass;

    $conectar = conn();
    $stmt = mysqli_prepare($conectar, "SELECT * FROM acceso WHERE user = ? AND pass = ?");
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $pass);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt) or mysqli_error($conectar);
    $total = mysqli_num_rows($resultado);
    if ($total > 0) {
        $_SESSION['user'] = $usuario;  // Guardar el usuario en la sesión
        header("Location: principal.php");  // Redirigir a la página protegida
        exit();
        echo "<br>Usuario y clave correctos";
    } else {
        //Redirigir el usuario al inicio de sesion en caso de error
        header("Location: index.php");
        echo '<div class="alert alert-danger" role="alert">Usuario y clave incorrectos</div>';
    }
        
}
?>
