<?php
require 'funciones.php';
session_start();

// Verifica si hay una sesión iniciada
if (!isset($_SESSION['user'])) {
    // Redirige a la página de inicio de sesión si no hay sesión
    header("Location: index.php");
    exit();
}
tiempoCierreSesion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENERAR INFORME - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2>Generar Informe</h2>
        <form action="informe.php" method="POST">
            <div class="mb-3">
                <label for="informeTipo" class="form-label">Selecciona el tipo de informe</label>
                <select class="form-select" id="informeTipo" name="informeTipo" required onchange="mostrarOpciones()">
                    <option value="">-- Selecciona --</option>
                    <option value="1">Inventario de Insumos</option>
                    <option value="2">Prácticas de un Insumo</option>
                    <option value="3">Insumos de una Práctica</option>
                </select>
            </div>

            <!-- Campo adicional para opción 2 -->
            <div class="mb-3 d-none" id="opcionInsumo">
                <label for="nombreInsumo" class="form-label">Nombre del Insumo</label>
                <input type="text" class="form-control" id="nombreInsumo" name="nombreInsumo">
            </div>

            <!-- Campo adicional para opción 3 -->
            <div class="mb-3 d-none" id="opcionPractica">
                <label for="nombrePractica" class="form-label">Nombre de la Práctica</label>
                <input type="text" class="form-control" id="nombrePractica" name="nombrePractica">
            </div>

            <button type="submit" class="btn btn-primary">Generar Informe</button>
        </form>
    </div>

    <script>
        function mostrarOpciones() {
            const informeTipo = document.getElementById("informeTipo").value;
            document.getElementById("opcionInsumo").classList.add("d-none");
            document.getElementById("opcionPractica").classList.add("d-none");

            if (informeTipo === "2") {
                document.getElementById("opcionInsumo").classList.remove("d-none");
            } else if (informeTipo === "3") {
                document.getElementById("opcionPractica").classList.remove("d-none");
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
