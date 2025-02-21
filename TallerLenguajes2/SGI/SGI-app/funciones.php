<?php

function encriptar($clave)
{
    $expRegPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,16}$/";
    $pass = "";
    if (preg_match($expRegPass, $clave)) {
        $contrasena = md5($clave);
        $arr2 = str_split($contrasena);
        for ($i = 0; $i < strlen($contrasena); $i++) {
            $pass = $pass . $arr2[$i] . "y" . $i * 3;
        }
        return $pass;
    }
}

function verificarTokenPass($user, $token)
{
    include_once("db.php");
    $conectar = conn();

    $stmt = mysqli_prepare($conectar, "SELECT token_password FROM acceso WHERE user = ? AND request_password = '1' LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $token_db = $row['token_password'];
        if ($token_db === $token) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}
function actualizarPass($pass, $user, $token)
{
    include_once("db.php");
    $conectar = conn();

    $stmt = mysqli_prepare($conectar, "UPDATE acceso SET pass = ?, request_password='0', token_password = '' WHERE user = ? AND token_password = ?");
    $stmt->bind_param("sis", $pass, $user, $token);
    $resultado = $stmt->execute();
    $stmt->close();
    return $resultado;
}
?>