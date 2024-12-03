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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $tipoT = $_POST["tipo_movimiento"];
    $implemento_fk = $_POST["implemento"];
    $cantidadP = $_POST["cantidadP"];
    $id_recibe = $_POST["id_recibe"];
    $nombre_recibe = $_POST["nombre_recibe"];
    $fecha_hora = $_POST["fecha_hora"];
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/Style.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
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

        .background-section {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url('ruta/a/tu/imagen-de-fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 600px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #007bff;
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
            <span class="navbar-text">
                <?php echo $_SESSION['user']; ?>
            </span>
        </div>
    </nav>
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#formulario_movimiento" role="button" aria-expanded="false" aria-controls="formulario_movimiento">
        <i class="fas fa-plus"></i> Registrar movimiento</a>
    <div class="collapse" id="formulario_movimiento">
        <h2 class="mb-4">Registro de movimientos</h2>
        <form action="movimientos.php" method="POST">
            <div class="form-group">
                <label for="tipo_movimiento">Tipo de Transaccion:</label>
                <select class="form-control" name="tipo_movimiento" required>
                    <option selected disabled>Seleccionar tipo</option>
                    <option value="PRESTAMO">Prestamo</option>
                    <option value="DEVOLUCION">Devolución</option>
                </select>
            </div>
            <div class="form-group">
                <label for="implemento">Implemento:</label>
                <select class="select2" name="implemento" required>
                    <option selected disabled>Seleccionar Implemento</option>
                    <?php
                    include_once("db.php");
                    $sql = "SELECT * FROM implemento";
                    $conectar = conn(); //crear la conexión a la b.d.
                    $result = mysqli_query($conectar, $sql) or trigger_error("Error:", mysqli_error($conectar));
                    while ($rowI = mysqli_fetch_array($result)) {
                        echo "<option value='" . $rowI['id_implemento'] . "'>" . $rowI['nombre_implemento'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidadP">Cantidad:</label>
                <input type="number" class="form-control" name="cantidadP" required>
            </div>
            <div class="form-group">
                <label for="id_recibe">Identificación de quien recibe:</label>
                <input type="text" class="form-control" name="id_recibe" required>
            </div>
            <div class="form-group">
                <label for="nombre_recibe">Nombre de quien recibe:</label>
                <input type="text" class="form-control" name="nombre_recibe" required>
            </div>
            <div class="form-group">
                <label for="fecha_hora">Fecha y hora:</label>
                <input type="datetime-local" class="form-control" name="fecha_hora" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de movimientos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tipo de movimiento</th>
                    <th>Implemento</th>
                    <th>Cantidad</th>
                    <th>Fecha y hora</th>
                    <th>Nombre de quien recibe</th>
                    <th>Usuario que entrega</th>
                    <th>Registrar devolución</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("db.php");
                $sql = "SELECT tipo_transaccion,i.nombre_implemento,cantidad,fecha_hora,nombre_recibe,user_fk FROM `transaccion`JOIN implemento AS i ON implemento_transa_fk=id_implemento WHERE tipo_transaccion='PRESTAMO'";
                $conectar = conn(); //crear la conexión a la b.d.
                $result = mysqli_query($conectar, $sql) or trigger_error("Error:", mysqli_error($conectar));
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['tipo_transaccion'] . "</td>";
                    echo "<td>" . $row['nombre_implemento'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>" . $row['fecha_hora'] . "</td>";
                    echo "<td>" . $row['nombre_recibe'] . "</td>";
                    echo "<td>" . $row['user_fk'] . "</td>";
                ?>
                <td>
                    <form action="movimientos.php?user=<?php echo $row['tipo_transaccion']; ?>" method="POST">
                        <input name="cantidadD" type="number" class="form-control" required>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i></button>
                    </form>
                </td>
                <?php
                    echo "</tr>";
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