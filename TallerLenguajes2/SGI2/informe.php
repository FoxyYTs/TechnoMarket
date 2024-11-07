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

// Verificar si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir el tipo de informe
    $informeTipo = $_POST["informeTipo"];
    if ($informeTipo == "2") {
        $dato = $_POST["nombreInsumo"];
        $tabla = array("Id Práctica", "Título");
    } else if ($informeTipo == "3") {
        $dato = $_POST["nombreGuia"];
        $tabla = array("Cantidad", "Nombre del implemento");
    } else {
        $dato = 0;
        $tabla = array("Nombre", "Stock", "Stock Minimo", "Estado");
    }
    $consulta = busquedaInformes($informeTipo, $dato);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFORME - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Informe</h1>
        <button onclick="generarPDF()" class="btn btn-primary mt-3">Generar PDF</button>
        <table class="table table-bordered table-striped table-light">
            <thead>
                <tr>
                    <?php
                    $encabezado = 0;
                    while ($encabezado < count($tabla)) {
                        echo "<th>" . $tabla[$encabezado] . "</th>";
                        $encabezado++;
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("db.php");
                $conectar = conn();
                $result = mysqli_query($conectar, $consulta) or trigger_error("Error:", mysqli_error($conectar));

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $col) {
                            echo "<td>" . htmlspecialchars($col) . "</td>";
                        }
                        // Verificación de stock y color
                        if ($informeTipo == "1") {
                            $color = ($row["stock_implemento"] <= $row["stock_minimo"]) ? "red" : "green";
                            $icon = ($row["stock_implemento"] <= $row["stock_minimo"]) ? "exclamation-circle" : "check-circle";
                            $message = ($row["stock_implemento"] <= $row["stock_minimo"]) ? "Bajo stock" : "En stock";

                            echo "<td style='background-color: $color; color: white;'>
                        <i class='fas fa-$icon' style='color: white;'></i> $message
                      </td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='" . (count($tabla) + 1) . "'>No hay resultados disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

</body>

</html>