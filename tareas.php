<?php
include 'auth.php';
include 'db_functions.php';

// Obtener el nombre de usuario
$nombre_usuario = obtenerNombreUsuario($idUsuario);

// Obtener el tipo de usuario
$tipo_usuario = obtenerTipoUsuario($idUsuario);

// Obtener las tareas del usuario
$tareas = obtenerTareasUsuario($conexion, $idUsuario);

// Función para calcular la duración
function calcularDuracion($fechaInicio, $fechaFin)
{
    if ($fechaFin === null) {
        $fechaFin = date('Y-m-d H:i:s'); // Fecha y hora actual
    }
    $duracion = strtotime($fechaFin) - strtotime($fechaInicio);
    $duracion_horas = floor($duracion / 3600); // Convertir segundos a horas
    $duracion_minutos = floor(($duracion - ($duracion_horas * 3600)) / 60); // Convertir segundos restantes a minutos
    return sprintf('%02d:%02d', $duracion_horas, $duracion_minutos); // Formato hh:mm
}


// Cerrar la conexión con la base de datos
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="8142791.png">
    <title>TaskTracking - Tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'cargando.php'; ?>
    <div class="container">
        <header>
            <h2>Tus Tareas de Hoy</h2>
        </header>
        <main>
            <a href="cerrar_sesion.php" class="waves-effect waves-light btn red right btn-small"><i class="fas fa-sign-out-alt"></i></a>
            <?php if ($tipo_usuario == 1) : ?>
                <a href="agregar_tarea.php" class="waves-effect waves-light btn green btn-small"><i class="fas fa-plus"></i></a>
            <?php endif; ?>
            <h5>HOLA, <?php echo htmlspecialchars($nombre_usuario); ?></h5>
            <p>Tus tareas de hoy son:</p>
            <div class="table-responsive">
                <table>
                    <tr>
                        <th>Cliente</th>
                        <th>Tarea</th>
                        <th class="hidden-column">Descripción</th>
                        <th>Ord. Compra</th>
                        <th>Asignada</th>
                        <th class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>">Personal</th>
                        <th class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>">Fec. Finalizacion</th>
                        <th class="hidden-column"> Estado</th>
                        <th>Duración</th>
                        <th>Procesar</th>
                        <th class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>">Acciones</th>
                    </tr>
                    <?php if (empty($tareas)) : ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">SIN TAREAS ASIGNADAS</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($tareas as $tarea) : ?>
                            <tr>
                                <td>
                                    <a href="#" class="cliente-link" data-razon="<?php echo htmlspecialchars($tarea['RazonSocial']); ?>" data-ruc="<?php echo htmlspecialchars($tarea['Ruc']); ?>">
                                        <?php echo htmlspecialchars($tarea['NombreAbrv']); ?>
                                    </a>
                                </td>
                                <td> <a href="#" class="tarea-link" data-descripcion="<?php echo htmlspecialchars($tarea['Descripcion']); ?>"><?php echo htmlspecialchars($tarea['Asunto']); ?></a></td>
                                <td class="hidden-column"><?php echo htmlspecialchars($tarea['Descripcion']); ?></td>
                                <td><a href="#" class="orden-link" data-descripord="<?php echo htmlspecialchars($tarea['DescripOrd']); ?>"><?php echo htmlspecialchars($tarea['CodOrden']); ?></a></td>
                                <td><?php echo htmlspecialchars($tarea['FecAsig']); ?></td>
                                <td class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>">
                                    <?php if (empty($tarea['Usuario'])) : ?>
                                        <a href="asignar_tarea.php?id=<?php echo $tarea['idTarea']; ?>">Asignar</a>
                                    <?php else : ?>
                                        <?php echo htmlspecialchars($tarea['Usuario']); ?>
                                    <?php endif; ?>
                                </td>
                                <td class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>"><?php echo htmlspecialchars($tarea['FecFinal'] ?? 'Sin Finalizar'); ?></td>
                                <td class="hidden-column"><?php echo htmlspecialchars($tarea['Estado']); ?></td>
                                <td class="duracion" data-fecasig="<?php echo $tarea['FecAsig']; ?>" data-fecfinal="<?php echo $tarea['FecFinal']; ?>">
                                    <?php
                                    // Calcular la duración inicial usando la función calcularDuracion
                                    $duracion = calcularDuracion($tarea['FecAsig'], $tarea['FecFinal']);
                                    echo htmlspecialchars($duracion);
                                    ?>
                                </td>
                                <td>
                                    <a href="procesar_tarea.php?id=<?php echo $tarea['idTarea']; ?>" class="waves-effect waves-light btn btn-small"><i class="fas fa-paper-plane"></i></a>
                                </td>
                                <td class="<?php echo $tipo_usuario == 1 ? '' : 'hidden-column'; ?>">
                                    <a href="editar_tarea.php?id=<?php echo $tarea['idTarea']; ?>&NombreAbrv=<?php echo urlencode($tarea['NombreAbrv']); ?>&Asunto=<?php echo urlencode($tarea['Asunto']); ?>&Descripcion=<?php echo urlencode($tarea['Descripcion']); ?>&CodOrden=<?php echo urlencode($tarea['CodOrden']); ?>&FecAsig=<?php echo urlencode($tarea['FecAsig']); ?>&Usuario=<?php echo urlencode($tarea['Usuario']); ?>&FecFinal=<?php echo urlencode($tarea['FecFinal']); ?>&Estado=<?php echo urlencode($tarea['Estado']); ?>" class="waves-effect waves-light btn btn-small blue">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="eliminar_tarea.php?id=<?php echo $tarea['idTarea']; ?>" class="waves-effect waves-light btn btn-small red"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </main>
    </div>
    <div id="tareaModal" class="modal">
        <div class="modal-content">
            <h5>Descripción de la Tarea</h5>
            <p id="descripcionTarea"></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
    <div id="ordenModal" class="modal">
        <div class="modal-content">
            <h5>Descripción de la Orden de Compra</h5>
            <p id="descripcionOrden"></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
    <div id="clienteModal" class="modal">
        <div class="modal-content">
            <h5>Descripción del Cliente</h5>
            <p>Razón Social: <span id="razonSocialCliente"></span></p>
            <p>RUC: <span id="rucCliente"></span></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
    <script src="modals.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        function calcularDuracion(fechaInicio, fechaFin) {
            var start = new Date(fechaInicio).getTime();
            var end = fechaFin ? new Date(fechaFin).getTime() : new Date().getTime();
            var duration = end - start;

            var days = Math.floor(duration / (1000 * 60 * 60 * 24));
            var hours = Math.floor((duration % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((duration % (1000 * 60)) / 1000);

            var result = '';
            if (days > 0) {
                result += days + (days === 1 ? 'd' : 'd') + ' ';
            }
            if (hours > 0) {
                result += hours + (hours === 1 ? 'h' : 'h') + ' ';
            }
            if (minutes > 0) {
                result += minutes + (minutes === 1 ? 'm' : 'm') + ' ';
            }
            if (seconds > 0) {
                result += seconds + (seconds === 1 ? 's' : 's');
            }

            // Eliminar la última coma y espacio si es necesario
            if (result.endsWith(', ')) {
                result = result.slice(0, -2);
            }

            return result;
        }

        function actualizarDuraciones() {
            var duraciones = document.querySelectorAll('.duracion');
            duraciones.forEach(function(duracion) {
                var fecAsig = duracion.getAttribute('data-fecasig');
                var fecFinal = duracion.getAttribute('data-fecfinal');
                duracion.textContent = calcularDuracion(fecAsig, fecFinal);
            });
        }

        // Actualizar las duraciones cada segundo
        setInterval(actualizarDuraciones, 1000);
        // Actualizar las duraciones inmediatamente al cargar la página
        actualizarDuraciones();
    </script>
</body>

</html>