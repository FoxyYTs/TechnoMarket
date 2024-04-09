<!DOCTYPE html>
<html lang="en">
<body background="fondo.jpeg">
<a href="consulta_animal.html">Consultar Animal</a> | 
<a href="consulta_estado.php">Consultar por Estado</a>
<br><p>
<?php
include_once("db.php");

$sql="SELECT * FROM animal"; 
//traemos toda la información de los animales de la B.D.

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "No se encontraron animales en la B.D.";
}
else{
    while($row_total=mysqli_fetch_assoc($resul)){
        $id_animal =$row_total['id_animal'];
        $nombre_animal =$row_total['nombre_animal'];
        $fecha_ingreso =$row_total['fecha_ingreso'];
        $fecha_salida =$row_total['fecha_salida'];
        $fecha_muerte =$row_total['fecha_muerte'];
        $estado_an =$row_total['estado_an'];
        $cod_esp_an =$row_total['cod_esp_an'];
        $imagen =$row_total['imagen'];

        echo "<img src='$imagen' width='300'><br>";
        echo "Identificación: $id_animal<br>";
        echo "Nombre: $nombre_animal<br>";
        echo "Fecha Ingreso: $fecha_ingreso<br>";
        echo "Fecha salida: $fecha_salida<br>";
        echo "Fecha muerte: $fecha_muerte<br>";
        echo "Estado: $estado_an<br>";
        echo "Especie: $cod_esp_an<br>";
        
    }   
}
?> 

</body>
</html>