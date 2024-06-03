<?php
session_start();
session_unset(); // Limpiar todas las variables de sesión
session_destroy(); // Destruir la sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskAbi</title>
    <link rel="icon"  type="image/png" href="8142791.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 360px;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1em;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Incluir la animación de carga -->
    <?php include 'cargando.php'; ?>

    <div class="container">
        <h1>Bienvenido a TaskAbi</h1>
        <form action="validar_login.php" method="post" onsubmit="mostrarCarga()">
            <input type="text" id="usuario" name="usuario" placeholder="Usuario/Correo" required>
            <input type="password" id="clave" name="clave" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión" class="button">
        </form>
    </div>

    <!-- Resto de tu código HTML y scripts -->
</body>
</html>
