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
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #007bff !important;
        }

        .nav-link {
            color: #555 !important;
        }

        .nav-link.active {
            color: #007bff !important;
        }

        .container {
            margin-top: 50px;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: #007bff;
            color: white;
            text-align: center;
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
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>