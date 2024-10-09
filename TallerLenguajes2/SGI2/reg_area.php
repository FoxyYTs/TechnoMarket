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
    $nombre_area= $_POST["nombre_area"];

    // Conectar a la base de datos
    include_once("db.php");
    $conectar = conn(); //conexion a la base de datos
    $sql = "INSERT INTO area (nombre_area) VALUES (?)";
    // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
    $stmt = $conectar->prepare($sql);
    //bind
    $stmt->bind_param("s", $nombre_area);
    // Ejecutar la sentencia SQL
    if ($stmt->execute()) {
        header("Location: gestion_Tmaestras.php");
        echo '<div class="alert alert-success" role="alert">Área creada correctamente</div>';
    } else {
        header("Location: reg_und_medida.php");
        echo '<div class="alert alert-warning" role="alert"> Error al crear el área: </div>' . $stmt->error;
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
            <span class="navbar-text">
                <?php echo $_SESSION['user']; ?>
            </span>
        </div>
    </nav>
        <!-- Formulario de registro -->
        <div class="container mt-5">
        <h2 class="mb-4">Registro de nueva área</h2>
        <form action="reg_area.php" method="POST">
            <div class="form-group">
                <label for="nombre_area">Nombre del área:</label>
                <input type="text" class="form-control" name="nombre_area" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>