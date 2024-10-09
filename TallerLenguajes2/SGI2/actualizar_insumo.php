<?php
include_once("db.php");

// Verificar si se ha recibido el ID del implemento en la URL
if (isset($_GET['id_implemento'])) {
    $id_implemento = $_GET['id_implemento'];

    // Conectar a la base de datos
    $conectar = conn();

    // Obtener los datos actuales del implemento
    $sql = "SELECT * FROM implemento WHERE id_implemento = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("i", $id_implemento);
    $stmt->execute();
    $result = $stmt->get_result();
    $implemento = $result->fetch_assoc();

    // Verificar si se ha recibido el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $foto = $_POST["foto"];
        $stock = $_POST["stock"];
        $ubicacion = $_POST["ubicacion"];
        $guia_uso = $_POST["guia_uso"];
        $medida = $_POST["und_medida"];

        // Preparar la sentencia SQL para actualizar el implemento
        $sql_update = "UPDATE implemento SET foto = ?, stock_implemento = ?, ubicacion_fk = ?, guia_uso_lab = ?, und_medida_fk = ? WHERE id_implemento = ?";
        $stmt_update = $conectar->prepare($sql_update);
        $stmt_update->bind_param("sissii", $foto, $stock, $ubicacion, $guia_uso, $medida, $id_implemento);

        // Ejecutar la sentencia SQL
        if ($stmt_update->execute()) {
            echo '<script>alert("implemento actualizado correctamente"); window.location.href = "gestionar_insumos.php";</script>';
        } else {
            echo '<script>alert("Error al actualizar implemento: ' . $stmt_update->error . '");</script>';
        }
        $stmt_update->close();
    }
    $stmt->close();
    $conectar->close();
} else {
    echo '<script>alert("No se ha recibido un ID de implemento válido"); window.location.href = "gestionar_insumos.php";</script>';
    exit();
}
?>
<?php
session_start();

// Verifica si hay una sesión iniciada
if (!isset($_SESSION['user'])) {
    // Redirige a la página de inicio de sesión si no hay sesión
    header("Location: login.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar implemento - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                require 'funciones.php';
                menu($_SESSION['user']);
                ?>
            </ul>
            <span class="navbar-text">
                <?php echo $_SESSION['user']; ?>
            </span>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Actualizar implemento</h1>
        <form action="actualizar_insumo.php?id_implemento=<?php echo $id_implemento; ?>" method="POST">
            <div class="form-group">
                <label for="foto">Enlace a foto de implemento:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <input type="text" class="form-control" name="foto" value="<?php echo $implemento['foto']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                    </div>
                    <input type="number" class="form-control" name="stock" value="<?php echo $implemento['stock_implemento']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                    <select class="form-control" name="ubicacion" required>
                        <option selected>Seleccione una ubicación</option>
                        <?php
                        $conectar = conn(); // Crear la conexión a la b.d.
                        $sql_ubicacion = "SELECT id_ubicacion FROM ubicacion ORDER BY id_ubicacion ASC";
                        $result_ubicacion = mysqli_query($conectar, $sql_ubicacion) or trigger_error("Error:", mysqli_error($conectar));
                        while ($row = mysqli_fetch_array($result_ubicacion)) {
                            $selected = ($row['id_ubicacion'] == $implemento['ubicacion_fk']) ? 'selected' : '';
                            echo "<option value='" . $row['id_ubicacion'] . "' $selected>" . $row['id_ubicacion'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Enlace a guía de uso:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <input type="text" class="form-control" name="guia_uso" value="<?php echo $implemento['guia_uso_lab']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="und_medida">Unidad de medida:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                    </div>
                    <select class="form-control" name="und_medida" required>
                        <option selected>Seleccione una unidad de medida</option>
                        <?php
                        $sql_medida = "SELECT * FROM unidad_medida ORDER BY id_medida ASC";
                        $result_medida = mysqli_query($conectar, $sql_medida) or trigger_error("Error:", mysqli_error($conectar));
                        while ($row = mysqli_fetch_array($result_medida)) {
                            $selected = ($row['id_medida'] == $implemento['und_medida_fk']) ? 'selected' : '';
                            echo "<option value='" . $row['id_medida'] . "' $selected>" . $row['nombre_medida'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>