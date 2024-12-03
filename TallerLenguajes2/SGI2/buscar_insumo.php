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
    <title>Buscar - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0"><i class="fas fa-search"></i> Buscar Insumo</h4>
                    </div>
                    <div class="card-body">
                        <form action="insumo.php" method="post">
                            <div class="form-group">
                                <label for="id_insumo"><i class="fas fa-barcode"></i> Código o nombre de Insumo:</label>
                                <input type="text" class="form-control" placeholder="Ingrese el código de insumo"
                                    name="implemento" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i>
                                Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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