<!DOCTYPE html>
<html lang="en">

<?php
include_once("db.php");
$usuario=$_POST["usuario"];
$clave=$_POST["clave"];

$sql="SELECT * FROM acceso where usuario='$usuario' AND clave='$clave'";
    //SELECT * FROM acceso where usuario='poli1' AND clave='poli123'

$conectar=conn();
$resul = mysqli_query($conectar,$sql) or trigger_error("Error:",mysqli_error($conectar));
$total = mysqli_num_rows($resul);

if($total==0){
    echo "El usuario o la clave son incorrectos!";
    //Se escribe acá el código html para redireccionar a login.html
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=login.html'>";
}
else{
    while($row_total=mysqli_fetch_assoc($resul)){
        $usuarioDB=$row_total['usuario'];
        $claveDB=$row_total['clave'];

        
        if ($usuario==$usuarioDB and $clave==$claveDB){
            echo "El usuario y la clave son correctos";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=menu.php'>";
        }
        
        else{
            echo "El usuario y la clave son incorrectos";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=login.html'>";
        }
    }   
}
?> 