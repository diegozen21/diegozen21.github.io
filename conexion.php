<?php
$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "id22241889_taskabi_db";

// Establecer conexión con la base de datos
$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $base_datos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}else{
   // echo('SI HAY CONEXION');
}
?>
