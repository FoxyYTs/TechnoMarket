<?php
    include_once("db.php");
    $id = $_POST["id"];
    echo "Esta es la id recibida: $id <br>";

    $sql = "SELECT * FROM usuarios";

    $conectar=conn();
    $resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
    $total = mysqli_num_rows($resul);

    if ($total == 0) {    
        echo "No se encontraron resultados <br>";
    }else {
        echo "Esto esta lleno de registros <br>";
        echo "<select name = 'estado'>";
        while($dato=mysqli_fetch_assoc($resul)){
            $nombres = $dato['nombres'];
            $ape= $dato['apellidos'];
            echo "<option value = $id>$nombres $ape</option>";
        }
        echo "</select>";
    }
?>