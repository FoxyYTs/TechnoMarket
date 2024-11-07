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
    $cantidad = $_POST["cantidad"];
    $id_recibe = $_POST["id_recibe"];
    $nombre_recibe = $_POST["nombre_recibe"];
    $fecha_hora = $_POST["fecha_hora"];
    $user = $_SESSION['user'];

    if ($tipoT == "PRESTAMO") {
        include_once("db.php");
        $sql = "SELECT id_implemento, stock_implemento FROM implemento";
        $conectar = conn(); //crear la conexión a la b.d.
        $result = mysqli_query($conectar, $sql) or trigger_error("Error:", mysqli_error($conectar));
        $row = mysqli_fetch_array($result);
        if ($cantidad > $row['stock_implemento']) {
            echo '<div class="alert alert-success" role="alert">No hay existencias sificientes</div>';
        } else {
            // Conectar a la base de datos
            include_once("db.php");
            $conectar = conn(); //conexion a la base de datos
            $sql = "INSERT INTO transaccion (tipo_transaccion, implemento_transa_fk, cantidad, id_recibe, nombre_recibe, fecha_hora, user_fk) VALUES (?, ?, ?, ?, ?, ?, ?)";
            // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
            $stmt = $conectar->prepare($sql);
            //bind
            $stmt->bind_param("siissss", $tipoT, $implemento_fk, $cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $user);
            // Ejecutar la sentencia SQL
            if ($stmt->execute()) {
                header("Location: movimientos.php");
                echo '<div class="alert alert-success" role="alert">Movimiento registrado correctamente</div>';
            } else {
                header("Location: movimientos.php");
                echo '<div class="alert alert-warning" role="alert"> Error al registrar movimiento </div>' . $stmt->error;
            }
            $stmt->close();
            $conectar->close();
        }
    } else {
        // Conectar a la base de datos
        include_once("db.php");
        $conectar = conn(); //conexion a la base de datos
        $sql = "INSERT INTO transaccion (tipo_transaccion, implemento_transa_fk, cantidad, id_recibe, nombre_recibe, fecha_hora, user_fk) VALUES (?, ?, ?, ?, ?, ?, ?)";
        // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
        $stmt = $conectar->prepare($sql);
        //bind
        $stmt->bind_param("siissss", $tipoT, $implemento_fk, $cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $user);
        // Ejecutar la sentencia SQL
        if ($stmt->execute()) {
            header("Location: movimientos.php");
            echo '<div class="alert alert-success" role="alert">Movimiento registrado correctamente</div>';
        } else {
            header("Location: movimientos.php");
            echo '<div class="alert alert-warning" role="alert"> Error al registrar movimiento </div>' . $stmt->error;
        }
        $stmt->close();
        $conectar->close();
    }
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
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

    <div class="container mt-5">
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
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['id_implemento'] . "'>" . $row['nombre_implemento'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" required>
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
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>

</html>