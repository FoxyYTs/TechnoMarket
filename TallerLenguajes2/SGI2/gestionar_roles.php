<?php
require 'funciones.php';
session_start();

// Verifica si hay una sesión iniciada
if (!isset($_SESSION['user'])) {
    // Redirige a la página de inicio de sesión si no hay sesión
    header("Location: login.php");
    exit();
}
tiempoCierreSesion();
?>

<?php
include_once("db.php");

// Verificar si se ha recibido el ID del implemento en la URL
if (isset($_GET['user'])) {
    $user = $_GET['user'];

    // Conectar a la base de datos
    $conectar = conn();

    // Obtener los datos actuales del implemento
    $sql = "SELECT * FROM acceso WHERE user = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $implemento = $result->fetch_assoc();

    // Verificar si se ha recibido el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $rol_fk = $_POST["rol"];

        // Preparar la sentencia SQL para actualizar el implemento
        $sql_update = "UPDATE acceso SET roles_fk = ? WHERE user = ?";
        $stmt_update = $conectar->prepare($sql_update);
        $stmt_update->bind_param("is", $rol_fk, $user);

        // Ejecutar la sentencia SQL
        if ($stmt_update->execute()) {
            echo '<script>alert("Rol asignado correctamente"); window.location.href = "gestionar_roles.php";</script>';
        } else {
            echo '<script>alert("Error al asignar rol: ' . $stmt_update->error . '");</script>';
        }
        $stmt_update->close();
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
    <title>ROLES - SGI LAB MANAGER</title>
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
                menu($_SESSION['user']);
                ?>
            </ul>
        </div>
    </nav>
    <!-- Mostrar todos los insumos -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Usuarios</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Asignar rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("db.php");
                $sql = "SELECT * FROM acceso ORDER BY user ASC";
                $conectar = conn(); //crear la conexión a la b.d.
                $result = mysqli_query($conectar, $sql) or trigger_error("Error:", mysqli_error($conectar));

                if ($result->num_rows > 0) {
                    while ($row_user = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row_user['user']}</td>
                            <td>{$row_user['roles_fk']}</td>";
                ?>
                        <td>
                            <form action="gestionar_roles.php?user=<?php echo $row_user['user']; ?>" method="POST">
                                <select name="rol" class="form-control" required>
                                    <option value="">Seleccione un rol</option>
                                    <?php
                                    $sql_roles = "SELECT * FROM roles ORDER BY id_rol ASC";
                                    $result_roles = mysqli_query($conectar, $sql_roles) or trigger_error("Error:", mysqli_error($conectar));                                    
                                    while ($row = mysqli_fetch_array($result_roles)) {
                                        $selected = ($row['id_rol'] == $row_user['roles_fk']) ? 'selected' : '';
                                        echo "<option value='" . $row['id_rol'] . "' $selected>" . $row['nombre_rol'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Asignar</button>
                            </form>
                        </td>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>