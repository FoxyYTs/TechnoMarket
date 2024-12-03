<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
function generaTokenPass($correo)
{
    include_once("db.php");
    $conectar = conn();

    $token = generaToken();
    $stmt = mysqli_prepare($conectar, "UPDATE acceso SET request_password='1', token_password = ? WHERE email = ?");
    $stmt->bind_param("ss", $token, $correo);
    $stmt->execute();
    $stmt->close();
    return $token;
}

function generaToken()
{
    $gen = md5(uniqid(mt_rand(), true));
    return $gen;
}

function getValor($campo, $campoWhere, $valor)
{
    include_once("db.php");
    $conectar = conn();

    $stmt = mysqli_prepare($conectar, "SELECT $campo FROM acceso WHERE $campoWhere = ?");
    mysqli_stmt_bind_param($stmt, "s", $valor);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt) or trigger_error("Error: ", mysqli_error($conectar));
    $total = mysqli_num_rows($resultado);

    if ($total > 0) {
        return $resultado->fetch_assoc()[$campo];
    } else {
        return false;
    }
}

function enviarCorreo($email, $nombre, $asunto, $cuerpo)
{

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bludu360@gmail.com';                     //SMTP username
    $mail->Password   = 'valzuafuphnupqhj';                               //SMTP password
    $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bludu360@gmail.com', 'Laboratorio Integrado');
    $mail->addAddress($email, $nombre);   //Optional name

    //Content

    $mail->CharSet = 'UTF-8';                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;
    $mail->isHTML(true);

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
function encriptar($clave)
{
    $expRegPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,16}$/";
    $pass = "";
    if (preg_match($expRegPass, $clave)) {
        $contrasena = md5($clave);
        $arr2 = str_split($contrasena);
        for ($i = 0; $i < strlen($contrasena); $i++) {
            $pass = $pass . $arr2[$i] . "y" . $i * 3;
        }
        return $pass;
    }
}

function verificarTokenPass($user, $token)
{
    include_once("db.php");
    $conectar = conn();

    $stmt = mysqli_prepare($conectar, "SELECT token_password FROM acceso WHERE user = ? AND request_password = '1' LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $token_db = $row['token_password'];
        if ($token_db === $token) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}
function actualizarPass($pass, $user, $token)
{
    include_once("db.php");
    $conectar = conn();

    $stmt = mysqli_prepare($conectar, "UPDATE acceso SET pass = ?, request_password='0', token_password = '' WHERE user = ? AND token_password = ?");
    $stmt->bind_param("sis", $pass, $user, $token);
    $resultado = $stmt->execute();
    $stmt->close();
    return $resultado;
}
function menu($user)
{
    include_once("db.php");
    $conectar = conn();
    $sql = "SELECT a.user AS nombre_usuario, r.nombre_rol, p.nombre_permiso, p.archivo FROM acceso AS a JOIN roles AS r ON a.roles_fk = r.id_rol JOIN permiso_rol AS pr ON r.id_rol = pr.rol_fk JOIN permisos AS p ON p.id_permisos = pr.permiso_fk WHERE a.user = ? AND p.archivo NOT LIKE 'gestion%'";

    $stmt = mysqli_prepare($conectar, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if ($resultado->num_rows > 0) {
        $nombre_usuario = ''; // Para guardar el nombre del usuario solo una vez

        while ($row = $resultado->fetch_assoc()) {
            if (empty($nombre_usuario)) {
                $nombre_usuario = $row['nombre_usuario']; // Guardar el nombre de usuario solo una vez
            }
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="' . $row['archivo'] . '">' . $row['nombre_permiso'] . '</a>';
            echo '</li>';
        }
        echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar</a>
        <ul class="dropdown-menu">' .
            menu_desplegable($nombre_usuario) . '
        </ul></li>';
        echo '<span class="navbar-text">' . $nombre_usuario . '</span>';
        echo '  </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>';
    }
}

function menu_desplegable($user)
{
    include_once("db.php");
    $conectar = conn();
    $sql = "SELECT a.user AS nombre_usuario, r.nombre_rol, p.nombre_permiso, p.archivo FROM acceso AS a JOIN roles AS r ON a.roles_fk = r.id_rol JOIN permiso_rol AS pr ON r.id_rol = pr.rol_fk JOIN permisos AS p ON p.id_permisos = pr.permiso_fk WHERE a.user = ? AND p.archivo LIKE 'gestion%'";

    $stmt = mysqli_prepare($conectar, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo '<li><a class="dropdown-item" href="' . $row['archivo'] . '">' . $row['nombre_permiso'] . '</a></li>';
        }
    }
}

function tiempoCierreSesion()
{

    date_default_timezone_set('America/Bogota'); // Zona horaria

    $hora_actual = date("H:i");

    $hora_cierre = "23:59";

    if ($hora_actual >= $hora_cierre) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}

function busquedaInformes($busqueda, $dato)
{
    switch ($busqueda) {
        case '1': #Inventario
            return "SELECT nombre_implemento, stock_implemento, stock_minimo FROM implemento";
            break;
        case '2': #Practicas donde se usa determinado insumo
            return "SELECT p.id_practica, g.nombre_guia
            FROM practica p
            JOIN guia g ON p.guia_fk = g.id_guia
            JOIN implemento i ON p.implemento_fk = i.id_implemento
            WHERE i.nombre_implemento LIKE '$dato%'";
            break;
        case '3': #Implementos de determinada guia
            return "SELECT i.nombre_implemento, ip.cantidad
            FROM implemento AS i
            JOIN practica AS ip ON i.id_implemento = ip.implemento_fk 
            JOIN guia AS g ON g.id_guia = ip.guia_fk
            WHERE g.nombre_guia LIKE '$dato%'";
            break;
        case '4': #Movimientos
        default:
            return 0;
            break;
    }
}
function generarConsultaMovimientos($opcion)
{
    switch ($opcion) {
        case 'PRESTAMO': //isssis
            return "INSERT INTO transaccion(tipo_transaccion, cantidad, id_recibe, nombre_recibe, fecha_hora, implemento_transa_fk, user_fk) VALUES ('PRESTAMO',?,?,?,?,?,?)";
            break;
        case 'DEVOLUCION': //isssisi
            return "INSERT INTO transaccion(tipo_transaccion, cantidad, id_recibe, nombre_recibe, fecha_hora, implemento_transa_fk, user_fk, prestamo_fk) VALUES ('DEVOLUCION',?,?,?,?,?,?,?)";
            //UPDATE transaccion SET devolucion_fk=? WHERE id_transaccion=?
            break;
        case 'ENTRADA':
            return "INSERT INTO reg_entrada(cantidad_entra, fecha_entrada, observaciones, proveedor_fk, implemento_entra_fk) VALUES (?,?,?,?,?)";
            break;
        case 'SALIDA':
            return "INSERT INTO reg_salida(cantidad_sale, fecha_salida, observaciones, implemento_sale_fk) VALUES (?,?,?,?)";
            break;
        default:
            return 0;
            break;
    }
}
function prestamo($cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $implemento, $user)
{
    include_once("db.php");
    $conectar = conn(); //conexion a la base de datos
    //Extraer el stock del implemento a prestar
    $sql_stock = "SELECT id_implemento, stock_implemento FROM implemento WHERE id_implemento = ?";
    $stmt = $conectar->prepare($sql_stock);
    $stmt->bind_param("i", $implemento);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_assoc();
    // Obtener el stock del implemento y compararlo con la cantidad a prestar
    $stock = $row['stock_implemento'];
    if ($cantidad > $stock) {
        echo '<div class="alert alert-success" role="alert">No hay existencias sificientes</div>';
    } else {
        $sql = generarConsultaMovimientos("PRESTAMO");
        // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
        $stmt = $conectar->prepare($sql);
        //bind
        $stmt->bind_param("isssis", $cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $implemento, $user);
        // Ejecutar la sentencia SQL
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Movimiento registrado correctamente</div>';
            // Actualizar el stock del implemento
            $nuevo_stock = $stock - $cantidad;
            $sql_stock = "UPDATE implemento SET stock_implemento = ? WHERE id_implemento = ?";
            $stmt = $conectar->prepare($sql_stock);
            $stmt->bind_param("ii", $nuevo_stock, $implemento);
            $stmt->execute();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al registrar movimiento</div>';
        }
        $stmt->close();
        $conectar->close();
    }
}
function devolucion($cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $implemento, $user, $id_prestamo)
{
    include_once("db.php");
    $conectar = conn(); //conexion a la base de datos
    //Estraer info de prestamo
    $sql_pres_dev = "SELECT cantidad FROM transaccion WHERE id_transaccion = ?";
    $stmt = $conectar->prepare($sql_pres_dev);
    $stmt->bind_param("i", $id_prestamo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_assoc();
    $canPrest = $row['cantidad'];
    //Extraer el stock del implemento a prestar
    $sql_stock = "SELECT id_implemento, stock_implemento FROM implemento WHERE id_implemento = ?";
    $stmt = $conectar->prepare($sql_stock);
    $stmt->bind_param("i", $implemento);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_assoc();
    // Obtener el stock del implemento
    $stock = $row['stock_implemento'];
    if ($cantidad > $canPrest) {
        echo '<div class="alert alert-success" role="alert">La cantidad a devolver es mayor a la cantidad prestada</div>';
    } else {
        $sql = generarConsultaMovimientos("DEVOLUCION");
        // Preparar la sentencia SQL para insertar una nueva reserva en la base de datos
        $stmt = $conectar->prepare($sql);
        //bind
        $stmt->bind_param("isssisi", $cantidad, $id_recibe, $nombre_recibe, $fecha_hora, $implemento, $user, $id_prestamo);
        // Ejecutar la sentencia SQL
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Movimiento registrado correctamente</div>';
            // Actualizar el stock del implemento
            $cantidad_actual = $canPrest - $cantidad;
            $sql_prestamo = "UPDATE transaccion SET cantidad = ? WHERE id_transaccion = ?";
            $stmt = $conectar->prepare($sql_prestamo);
            $stmt->bind_param("ii", $cantidad_actual, $id_prestamo);
            $stmt->execute();

            $nuevo_stock = $stock + $cantidad;
            $sql_stock = "UPDATE implemento SET stock_implemento = ? WHERE id_implemento = ?";
            $stmt = $conectar->prepare($sql_stock);
            $stmt->bind_param("ii", $nuevo_stock, $implemento);
            $stmt->execute();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al registrar movimiento</div>';
        }
        $stmt->close();
        $conectar->close();
    }
}
