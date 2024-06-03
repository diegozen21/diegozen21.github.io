<?php
include 'conexion.php';

function obtenerNombreUsuario($idUsuario) {
    global $conexion;

    // Preparar la llamada al procedimiento almacenado
    $sql = "CALL nombre_usuario(?, @nombre_apellido)";
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular el parámetro y ejecutar la consulta
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->close();

        // Obtener el resultado del procedimiento almacenado
        $resultado = $conexion->query("SELECT @nombre_apellido AS nombre_apellido");
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['nombre_apellido'];
        }
    }

    // Devolver "Usuario" si algo falla
    return "Usuario";
}

function obtenerTareasUsuario($conexion, $idUsuario) {
    $sql_tareas_usuario = "CALL obtener_tareas_usuario(?)";
    if ($stmt = $conexion->prepare($sql_tareas_usuario)) {
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $tareas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $tareas[] = $fila;
        }
        $stmt->close();
        return $tareas;
    }
    return [];
}

function obtenerTipoUsuario($idUsuario) {
    global $conexion;

    // Preparar la llamada al procedimiento almacenado
    $sql = "CALL obtener_tipo_usuario(?, @idTipoUsuario)";
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular el parámetro y ejecutar la consulta
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->close();

        // Obtener el resultado del procedimiento almacenado
        $resultado = $conexion->query("SELECT @idTipoUsuario AS idTipoUsuario");
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['idTipoUsuario'];
        }
    }

    // Devolver un valor predeterminado si algo falla
    return null;
}
?>
