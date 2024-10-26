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
                menu($_SESSION['user']);
                ?>
            </ul>
        </div>
    </nav>
    <!-- Mostrar todos los insumos -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Implementos</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID IMPLEMENTO</th>
                    <th>NOMBRE</th>
                    <th>STOCK</th>
                    <th>UBICACION</th>
                    <th>UNIDAD DE MEDIDA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("db.php");
                $sql = "SELECT * FROM implemento JOIN unidad_medida ON unidad_medida.id_medida=implemento.und_medida_fk ORDER BY id_implemento ASC";
                $conectar = conn(); //crear la conexión a la b.d.
                $result = mysqli_query($conectar, $sql) or trigger_error("Error:", mysqli_error($conectar));

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id_implemento']}</td>
                            <td><a href='insumo.php?id_implemento={$row['id_implemento']}'>{$row['nombre_implemento']}</a></td>
                            <td>{$row['stock_implemento']}</td>
                            <td>{$row['ubicacion_fk']}</td>
                            <td>{$row['nombre_medida']}</td>";
                ?>
                        <td>
                            <a href="actualizar_insumo.php?id_implemento=<?php echo $row['id_implemento']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Actualizar</a>
                            <a href="eliminar_insumo.php?id_implemento=<?php echo $row['id_implemento']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        </td>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No hay implementos registrados</td></tr>";
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