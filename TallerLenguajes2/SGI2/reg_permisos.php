<?php
session_start();

// Verifica si hay una sesión iniciada
if (!isset($_SESSION['user'])) {
    // Redirige a la página de inicio de sesión si no hay sesión
    header("Location: login.php");
    exit();
}

//Validacion y registro de Implemento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre_per= $_POST["nombre_permiso"];
    $desc_per= $_POST["descripcion_permiso"];
    $archivo = $_POST["archivo"];

    // Conectar a la base de datos
    include_once("db.php");
    $conectar = conn(); //conexion a la base de datos
    $sql = "INSERT INTO permisos (nombre_permiso,descripcion_permiso,archivo) VALUES (?, ?, ?)";
    // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
    $stmt = $conectar->prepare($sql);
    //bind
    $stmt->bind_param("sss", $nombre_per, $desc_per, $archivo);
    // Ejecutar la sentencia SQL
    if ($stmt->execute()) {
        header("Location: gestion_Tmaestras.php");
        echo '<div class="alert alert-success" role="alert">Nuevo permiso creado correctamente</div>';
    } else {
        header("Location: reg_permisos.php");
        echo '<div class="alert alert-warning" role="alert"> Error al crear nuevo permiso: </div>' . $stmt->error;
    }
    $stmt->close();
    $conectar->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMPLEMENTOS - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        th,
        td {
            vertical-align: middle !important;
        }
    </style>
</head>

<body>
    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand active" href="principal.php">LAB MANAGER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav nav-tabs">
                <?php
                require 'funciones.php';
                menu($_SESSION['user']);
                ?>
            </ul>
        </div>
    </nav>
    <!-- Formulario de registro -->
    <div class="container mt-5">
        <h2 class="mb-4">Registro de nuevo permiso</h2>
        <form action="reg_permisos.php" method="POST">
            <div class="form-group">
                <label for="nombre_permiso">Título de permiso:</label>
                <input type="text" class="form-control" name="nombre_permiso" required>
            </div>
            <div class="form-group">
                <label for="descripcion_permiso">Descripcion del permiso:</label>
                <input type="text" class="form-control" name="descripcion_permiso" required>
            </div>
            <div class="form-group">
                <label for="archivo">Archivo:</label>
                <input type="text" class="form-control" name="archivo" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>