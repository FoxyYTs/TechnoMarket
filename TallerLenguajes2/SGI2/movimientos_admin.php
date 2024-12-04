<?php
require 'funciones.php';
include_once("db.php");
session_start();
// Verifica si hay una sesión iniciadas
if (!isset($_SESSION['user'])) {
    // Redirige a la página de inicio de sesión si no hay sesión
    header("Location: index.php");
    exit();
}
tiempoCierreSesion();


// Recoger datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoT = $_POST["tipo_movimiento"];
    $id_transaccion = isset($_GET['id_transaccion']) ? $_GET['id_transaccion'] : null;
    $user = $_SESSION['user'];

    if ($tipoT == "PRESTAMO") {
        // Recoger datos del formulario
        $implemento_fk = $_POST["implemento"];
        $cantidadP = $_POST["cantidad"];
        $id_recibe = $_POST["id_recibe"];
        $nombre_recibe = $_POST["nombre_recibe"];
        $fecha_hora = $_POST["fecha_hora"];
        prestamo($cantidadP, $id_recibe, $nombre_recibe, $fecha_hora, $implemento_fk, $user);
    } elseif ($tipoT == "ENTRADA") {
        // Recoger datos del formulario
        $implemento = $_POST["implemento"];
        $cantidad = $_POST["cantidad"];
        $observaciones = $_POST["observaciones"];
        $proveedor = $_POST["proveedor"];
        $fecha_hora = $_POST["fecha_hora"];
        entrada($cantidad, $fecha_hora, $implemento, $observaciones, $proveedor, $user);
    } elseif ($tipoT == "SALIDA") {
        // Recoger datos del formulario
        $implemento = $_POST["implemento"];
        $cantidad = $_POST["cantidad"];
        $observaciones = $_POST["observaciones"];
        $fecha_hora = $_POST["fecha_hora"];
        salida($cantidad, $fecha_hora, $implemento, $observaciones, $user);
    } else {
        // Recoger datos del formulario
        $cantidadD = $_POST["cantidadD"];
        $conectar = conn();
        $sql_devolucion = "SELECT * FROM transaccion WHERE id_transaccion = ?";
        $stmt = $conectar->prepare($sql_devolucion);
        $stmt->bind_param("i", $id_transaccion);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();
        devolucion($cantidadD, $row["id_recibe"], $row["nombre_recibe"], $row["fecha_hora"], $row["implemento_transa_fk"], $row["user_fk"], $id_transaccion);
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
        </div>
    </nav>
    <div class="container content-center">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#formulario_movimiento" role="button" aria-expanded="false" aria-controls="formulario_movimiento">
            <i class="fas fa-plus"></i> Registrar movimiento</a>
        <div class="row justify-text-start">
            <div class="collapse" id="formulario_movimiento">
                <h2 class="mb-4">Registro de movimientos</h2>
                <form action="movimientos_admin.php" method="POST">
                    <div class="form-group">
                        <label for="tipo_movimiento">Tipo de Transaccion:</label>
                        <select class="form-control" id="tipo_movimiento" name="tipo_movimiento" required onchange="mostrarCampos()">
                            <option selected disabled>Seleccionar tipo</option>
                            <option value="PRESTAMO">Prestamo</option>
                            <option value="ENTRADA">Entrada</option>
                            <option value="SALIDA">Salida</option>
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
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="cantidad" required>
                    </div>
                    <div class="form-group d-none" id="id_recibe">
                        <label for="id_recibe">Identificación de quien recibe:</label>
                        <input type="text" class="form-control" name="id_recibe" required>
                    </div>
                    <div class="form-group d-none" id="nombre_recibe">
                        <label for="nombre_recibe">Nombre de quien recibe:</label>
                        <input type="text" class="form-control" name="nombre_recibe" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y hora:</label>
                        <input type="datetime-local" class="form-control" name="fecha_hora" required>
                    </div>
                    <!-- Campo adicional para Entrada -->
                    <div class="form-group d-none" id="entrada">
                        <label for="proovedor" class="form-label">Nombre del Proveedor</label>
                        <select class="select" name="proveedor" required>
                            <option selected disabled>Seleccionar Proveedor</option>
                            <?php
                            include_once("db.php");
                            $sqlP = "SELECT * FROM proveedor ORDER BY id_proveedor ASC";
                            $conectar = conn(); //crear la conexión a la b.d.
                            $result = mysqli_query($conectar, $sqlP) or trigger_error("Error:", mysqli_error($conectar));
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['id_proveedor'] . "'>" . $row['nombre_proveedor'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Campo adicional para Entrada y Salida -->
                    <div class="form-group d-none" id="entrada_salida">
                        <label for="Observaciones" class="form-label">Observaciones</label>
                        <input type="text" class="form-control" name="observaciones" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de movimientos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
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
    <script>
        function mostrarCampos() {
            const tipo_movimiento = document.getElementById("tipo_movimiento").value;
            document.getElementById("entrada").classList.add("d-none");
            document.getElementById("entrada_salida").classList.add("d-none");
            document.getElementById("nombre_recibe").classList.add("d-none");
            document.getElementById("id_recibe").classList.add("d-none");

            if (tipo_movimiento === "ENTRADA" || tipo_movimiento === "SALIDA") {
                document.getElementById("entrada_salida").classList.remove("d-none");
                if (tipo_movimiento === "ENTRADA") {
                    document.getElementById("entrada").classList.remove("d-none");
                }
            } else if (tipo_movimiento === "PRESTAMO") {
                document.getElementById("id_recibe").classList.remove("d-none");
                document.getElementById("nombre_recibe").classList.remove("d-none");
            }
        }
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>