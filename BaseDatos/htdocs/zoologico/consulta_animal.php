<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Consulta de Clientes</title>
</head>

<?php
//consulta_cliente.php
include_once("db.php");
$id=$_POST["id"];
$sql="SELECT * from animal where id_animal='$id'";

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "No se encontró ningún animal";
}
else{
    while($row_total=mysqli_fetch_assoc($resul)){
        $id_animal=$row_total['id_animal'];
        $nombre_animal=$row_total['nombre_animal'];
        $fecha_ingreso=$row_total['fecha_ingreso'];
        $fecha_salida=$row_total['fecha_salida'];
        $fecha_muerte=$row_total['fecha_muerte'];
        $estado_an=$row_total['estado_an'];
        $imagen=$row_total['imagen'];

        echo "Nombres: $nombre_animal <br>";
        echo "Fecha Ingreso: $fecha_ingreso <br>";
        echo "Fecha Salida: $fecha_salida <br>";
        echo "Fecha Muerte: $fecha_muerte <br>";
        echo "Estado: $estado_an <br>";
        echo "<img src='$imagen' width='300'>";
        echo "<p>";
        
    }   
}
?> 