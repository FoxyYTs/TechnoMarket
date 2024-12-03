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

$q = $_GET['q']; // Captura el término de búsqueda
$conectar = conn();

$sql = "SELECT nombre_implemento, tipo, cantidad 
        FROM implemento 
        WHERE nombre_implemento LIKE ? OR tipo LIKE ?";
$stmt = $conectar->prepare($sql);
$search = "%" . $q . "%";
$stmt->bind_param('ss', $search, $search);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['nombre_implemento']) . "</td>
                <td>" . htmlspecialchars($row['tipo']) . "</td>
                <td>" . htmlspecialchars($row['cantidad']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
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
                menu($_SESSION['user']);
                ?>
            </ul>
        </div>
    </nav>
    <!-- Mostrar todos los insumos -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Implementos</h1>
        <table class="table table-hover table-striped mt-3">
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
            <tbody id="table-body">
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
                            <a href="registrar_entrada.php?id_implemento=<?php echo $row['id_implemento']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-cart-plus-fill"></i>Nueva Entrada</a>
                            <a href="registrar_salida.php?id_implemento=<?php echo $row['id_implemento']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-cart-dash-fill"></i>Salida</a>
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
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
</body>

</html>