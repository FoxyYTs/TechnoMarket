<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Consulta de Clientes</titlex|>
</head>

<?php
//consulta_cliente.php
include_once("db.php");
$id=$_POST["id"];
$sql="SELECT * from usuarios where id='$id'";

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "No se encontró ningún cliente";
}
else{
    while($row_total=mysqli_fetch_assoc($resul)){
        $nombres=$row_total['nombres'];
        $apellidos=$row_total['apellidos'];
        $fecha_nacimiento=$row_total['fecha_nacimiento'];
        $genero=$row_total['genero'];
        $nivel_estudios=$row_total['nivel_estudios'];
        $usuario=$row_total['usuario'];
        $clave=$row_total['clave'];

        echo "Nombres: $nombres <br>";
        echo "Apellidos: $apellidos <br>";
        echo "Fecha nacimiento: $fecha_nacimiento <br>";
        echo "Genero: $genero <br>";
        echo "Nivel de estudios: $nivel_estudios <br>";
        echo "Usuario: $usuario <br>";
        echo "Clave: $clave <br>";

        ?>
        <form name="formUpdate" action="actualizar_cliente.php" method="post">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Fecha Nacimiento</th>
            <th scope="col">Genero</th>
            <th scope="col">Nivel de estudios</th>
            <th scope="col">Usuario</th>
            <th scope="col">Clave</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>
                <input type="text" value="<?php echo $nombres ?>" name="nombres"> 
                <!--<input type="text" value="Maria Teresa" name="nombre">-->
            </td>
            <td>
            <input type="text" value="<?php echo $apellidos ?>" name="apellidos">
            </td>
            <td><?php echo $fecha_nacimiento?></td>
            <td><?php echo $genero?></td>
            <td><?php echo $nivel_estudios?></td>
            <td><?php echo $usuario?></td>
            <td><?php echo $clave?></td>
            </tr>
            <input type="hidden" value="<?php echo $id ?>" name="id">
            
        </tbody>
        </table>
        <input class="btn btn-danger" type="submit" value="Actualizar">
    </form>
        <?php
    }
}
?>
