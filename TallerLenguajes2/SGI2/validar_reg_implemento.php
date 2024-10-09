<?php
        // Verificar si se ha enviado el formulario
        //Validacion y registro de Implemento
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger datos del formulario
            $nombre= $_POST["nombre_implemento"];
            $stock= $_POST["stock_implemento"];
            $foto= $_POST["foto"];
            $ubicacion= $_POST["ubicacion"];
            $und_medida= $_POST["und_medida"];
            $ficha_tecnica= $_POST["ficha_tecnica"];
            $guia= $_POST["guia_uso_lab"];

            // Conectar a la base de datos
            include_once("db.php");
            $conectar = conn(); //conexion a la base de datos
            $sql = "INSERT INTO implemento (nombre_implemento,stock_implemento,foto,ubicacion_fk,und_medida_fk,ficha_tecnica,guia_uso_lab) VALUES (?, ?, ?, ?, ?, ?, ?)";
            // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
            $stmt = $conectar->prepare($sql);
            //bind
            $stmt->bind_param("sississ", $nombre, $stock, $foto, $ubicacion, $und_medida, $ficha_tecnica, $guia);
            // Ejecutar la sentencia SQL
            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">Implemento registrado correctamente</div>';
                header("Location: registro_insumo.php"); 
            } else {
                echo '<div class="alert alert-danger" role="alert"> Error al registrar implemento: </div>' . $stmt->error;
                header("Location: registro_insumo.php");  
            }
            $stmt->close();
            $conectar->close();
        }

?>