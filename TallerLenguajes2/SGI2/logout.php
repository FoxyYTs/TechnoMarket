<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];
session_unset();  // Destruir todas las variables de sesión

// Destruir la sesión completamente
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: index.php");
exit();
?>
