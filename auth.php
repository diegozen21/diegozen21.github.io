<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Redireccionar al formulario de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Obtener el idUsuario de la sesión
$idUsuario = $_SESSION['idUsuario'];
?>
