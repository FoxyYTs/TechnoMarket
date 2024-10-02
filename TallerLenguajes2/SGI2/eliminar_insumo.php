<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recoger datos del formulario
    $id_implemento = $_GET["id_implemento"];

    // Conectar a la base de datos
    include_once("db.php");
    $conectar = conn(); // Conexión a la base de datos

    // Deshabilitar las comprobaciones de claves foráneas
    $sql_disable_fk_checks = "SET FOREIGN_KEY_CHECKS = 0";
    if (!$conectar->query($sql_disable_fk_checks)) {
        echo "Error deshabilitando las comprobaciones de claves foráneas: " . $conectar->error;
        exit();
    }

    // Eliminar el registro
    $sql_delete = "DELETE FROM implemento WHERE id_implemento = ?";
    $stmt = $conectar->prepare($sql_delete);
    $stmt->bind_param("i", $id_implemento);

    if ($stmt->execute()) {
        // Mensaje de éxito
        echo '<script>';
        echo 'setTimeout(function() {';
        echo 'alert("Implemento eliminado correctamente");';
        echo 'window.location.href = "gestionar_insumos.php";'; // Redirigir a insumos.php después de 1 segundo
        echo '}, 1000);'; // Tiempo en milisegundos (1 segundo)
        echo '</script>';
    } else {
        // Mensaje de error
        echo '<script>';
        echo 'setTimeout(function() {';
        echo 'alert("Error al eliminar Implemento: ' . $stmt->error . '");';
        echo 'window.location.href = "gestionar_insumos.php";'; // Redirigir a insumos.php después de 1 segundo
        echo '}, 1000);'; // Tiempo en milisegundos (1 segundo)
        echo '</script>';
    }

    // Habilitar las comprobaciones de claves foráneas
    $sql_enable_fk_checks = "SET FOREIGN_KEY_CHECKS = 1";
    if (!$conectar->query($sql_enable_fk_checks)) {
        echo "Error habilitando las comprobaciones de claves foráneas: " . $conectar->error;
        exit();
    }

    $stmt->close();
    $conectar->close();
}
?>