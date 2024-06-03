<?php
session_start();
include 'conexion.php';

// Verificar si los datos del formulario están establecidos
if (!isset($_POST['usuario']) || !isset($_POST['clave'])) {
    echo "<script>alert('Hubo un error, intente nuevamente.'); window.location.href = 'index.php';</script>";
    exit();
}

// Obtener los datos del formulario de inicio de sesión
$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$clave = mysqli_real_escape_string($conexion, $_POST['clave']);

// Llamar al procedimiento almacenado para validar el inicio de sesión
$sql = "CALL p_validar_usuario('$usuario', '$clave', @idUsuario)";
if (!mysqli_query($conexion, $sql)) {
    error_log("Error en la consulta SQL: " . mysqli_error($conexion));
    echo "<script>alert('Hubo un error, intente nuevamente.'); window.location.href = 'index.php';</script>";
    exit();
}

// Obtener el resultado del procedimiento almacenado
$sql_resultado = mysqli_query($conexion, "SELECT @idUsuario AS idUsuario");
if ($sql_resultado) {
    if ($sql_resultado->num_rows > 0) {
        $fila = $sql_resultado->fetch_assoc();
        $idUsuario = $fila['idUsuario'];

        if ($idUsuario > 0) {
            // Inicio de sesión exitoso, almacenar el idUsuario en la sesión
            $_SESSION['idUsuario'] = $idUsuario;
            header("Location: tareas.php"); // Redireccionar a la página de inicio después del inicio de sesión exitoso
            exit();
        } else {
            // Credenciales incorrectas, mostrar mensaje de error y redirigir
            echo "<script>alert('Usuario/Correo o contraseña incorrectos. Inténtalo de nuevo.'); window.location.href = 'index.php';</script>";
            exit();
        }
    } else {
        // No se obtuvo un resultado esperado del procedimiento almacenado
        error_log("No se obtuvo un resultado esperado del procedimiento almacenado.");
        echo "<script>alert('Hubo un error, intente nuevamente.'); window.location.href = 'index.php';</script>";
        exit();
    }
} else {
    // Error en la ejecución del query
    error_log("Error en la ejecución del query: " . mysqli_error($conexion));
    echo "<script>alert('Hubo un error, intente nuevamente.'); window.location.href = 'index.php';</script>";
    exit();
}

// Cerrar la conexión con la base de datos
?>
