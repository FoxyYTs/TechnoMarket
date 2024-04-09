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
//consulta_cliente.php
include_once("db.php");
//$id=$_POST["id"];
$sql="SELECT * from estado";

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "No se encontraron estados";
}
else{
    echo "<form name='consulta' action='listar_estado.php' method='post'>";
    echo "Consulta animales por estado: ";
    echo "<select name='estado'>";
    while($row_total=mysqli_fetch_assoc($resul)){
        $id_estado=$row_total['id_estado'];
        $nombre_estado=$row_total['nombre_estado'];

        echo "<option value='$id_estado'>$nombre_estado</option>";  
    }   
    echo "</select>";
    echo "<input type='submit' value='CONSULTAR'>";
    echo "</form>";
}
?> 