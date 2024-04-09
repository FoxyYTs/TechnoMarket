<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Consulta de Animales por estado</title>
</head>

<?php
include_once("db.php");
$estado=$_POST["estado"];
$sql="SELECT id_animal,nombre_animal,imagen from animal where estado_an=$estado";

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "No se encontraron animales en el estado $estado";
}
else{
    while($row_total=mysqli_fetch_assoc($resul)){
        $id_animal=$row_total['id_animal'];
        $nombre_animal=$row_total['nombre_animal'];
        $imagen=$row_total['imagen'];

        echo "<img src='$imagen'><p>";
        echo "identificación: $id_animal<br>";
        echo "Nombre: $nombre_animal<p>";
    }   

}
?> 