<?php
session_start();
// Destruir todas las variables de sesión
$_SESSION = [];
session_unset(); 

// Destruir la sesión completamente
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SGI LAB MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('https://media.gettyimages.com/id/1450931952/es/foto/laboratorio-de-ciencias-con-microscopios-computadoras-y-equipos-de-laboratorio.jpg?s=2048x2048&w=gi&k=20&c=Y3IooySiL4JbUStqzXpJgoLMYcp02nlWc9BO4iUHToo=');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h3><i class="fas fa-user-lock"></i> Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="user"><i class="fas fa-user"></i> Usuario</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="fas fa-lock"></i> Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
                            </div>
                            <div class="form-group text-center">
                                <a class="btn btn-link" href="recuperar.html">Olvide mi Contraseña</a> o <a class="btn btn-link" href="registrarse.html">Crear Cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>
