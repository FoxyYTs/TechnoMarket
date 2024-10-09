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
    $rol = $_POST["rol"];
    $permiso = $_POST["permiso"];

    // Conectar a la base de datos
    include_once("db.php");
    $conectar = conn(); //conexion a la base de datos
    $sql = "INSERT INTO permiso_rol (permiso_fk, rol_fk) VALUES (?, ?)";
    // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
    $stmt = $conectar->prepare($sql);
    //bind
    $stmt->bind_param("ii", $permiso, $rol);
    // Ejecutar la sentencia SQL
    if ($stmt->execute()) {
        header("Location: gestion_Tmaestras.php");
        echo '<div class="alert alert-success" role="alert">Asignado correctamente</div>';
    } else {
        header("Location: reg_und_medida.php");
        echo '<div class="alert alert-warning" role="alert"> Error al asignar: </div>' . $stmt->error;
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
        <h2 class="mb-4">Asignación de permisos</h2>
        <form action="gestionar_permisos.php" method="POST">
            <?php
            include_once("db.php");
            $conectar = conn(); //crear la conexión a la b.d.
            ?>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select name="rol" class="form-control" required>
                    <option value="">Seleccione un rol</option>
                    <?php
                    $sql_roles = "SELECT * FROM roles ORDER BY id_rol ASC";
                    $result_roles = mysqli_query($conectar, $sql_roles) or trigger_error("Error:", mysqli_error($conectar));
                    while ($row_rol = mysqli_fetch_array($result_roles)) {
                        echo "<option value='" . $row_rol['id_rol'] . "'>" . $row_rol['nombre_rol'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="permiso">Permiso:</label>
                <select name="permiso" class="form-control" required>
                    <option value="">Seleccione un permiso</option>
                    <?php
                    $sql_permisos = "SELECT * FROM permisos ORDER BY id_permisos ASC";
                    $result_permisos = mysqli_query($conectar, $sql_permisos) or trigger_error("Error:", mysqli_error($conectar));
                    while ($row = mysqli_fetch_array($result_permisos)) {
                        echo "<option value='" . $row['id_permisos'] . "'>" . $row['nombre_permiso'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Asignar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>