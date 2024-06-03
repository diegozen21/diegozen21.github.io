<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="8142791.png">
    <title>Agregar Tarea</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    < </head>

<body>
    <div class="container">
        <br></br>
        <a href="Tareas.php" class="waves-effect waves-light btn green btn-small">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Agregar Nueva Tarea</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-field">
                <select id="cliente" name="cliente" required>
                    <option value="" disabled selected>Seleccionar Cliente</option>
                    <option value="cliente1">Cliente 1</option>
                    <option value="cliente2">Cliente 2</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
                <label for="cliente">Cliente</label>
                <br>
                <a class="btn modal-trigger" href="#modalCliente">Agregar Cliente</a>
            </div>
            <div class="input-field">
                <input type="text" id="tarea" name="tarea" required>
                <label for="tarea">Tarea</label>
            </div>
            <div class="input-field">
                <textarea id="descripcion" name="descripcion" class="materialize-textarea" required></textarea>
                <label for="descripcion">Descripción</label>
            </div>
            <div class="input-field">
                <select id="orden_compra" name="orden_compra" required>
                    <option value="" disabled selected>Seleccionar Orden de Compra</option>
                    <option value="orden1">Orden 1</option>
                    <option value="orden2">Orden 2</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
                <label for="orden_compra">Orden de Compra</label>
                <a class="btn modal-trigger" href="#modalOrden">Agregar Orden</a>
            </div>
            <div class="input-field">
                <select id="usuario_asignado" name="usuario_asignado" required>
                    <option value="" disabled selected>Seleccionar Usuario</option>
                    <option value="usuario1">Usuario 1</option>
                    <option value="usuario2">Usuario 2</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
                <label for="usuario_asignado">Empleado Asignado</label>
                <a class="btn modal-trigger" href="#modalEmpleado">Agregar Empleado</a>
            </div>
            <button type="submit" class="btn">Crear Tarea</button>
        </form>
    </div>

    <!-- Modal para agregar empleado -->
    <div id="modalEmpleado" class="modal">
        <div class="modal-header">
            <a href="#!" class="modal-close right"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-content">
            <h5>Agregar Nuevo Empleado</h5>
            <form>
                <label for="nombre_empleado">Nombres:</label>
                <input type="text" id="nombre_empleado" name="nombre_empleado" required><br>

                <label for="apellido_paterno_empleado">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno_empleado" name="apellido_paterno_empleado" required><br>

                <label for="apellido_materno_empleado">Apellido Materno:</label>
                <input type="text" id="apellido_materno_empleado" name="apellido_materno_empleado"><br>

                <label for="usuario_empleado">Usuario:</label>
                <input type="text" id="usuario_empleado" name="usuario_empleado" required><br>

                <label for="clave_empleado">Clave:</label>
                <input type="password" id="clave_empleado" name="clave_empleado" required><br>

                <label for="correo_empleado">Correo:</label>
                <input type="email" id="correo_empleado" name="correo_empleado"><br>

                <label for="celular_empleado">Celular:</label>
                <input type="tel" id="celular_empleado" name="celular_empleado"><br>

                <input type="submit" value="Guardar">
            </form>
        </div>

    </div>

    <!-- Modal para agregar cliente -->
    <div id="modalCliente" class="modal">
        <div class="modal-content">
            <h5>Agregar Nuevo Cliente</h5>
            <form>
                <label for="ruc_cliente">RUC:</label>
                <input type="text" id="ruc_cliente" name="ruc_cliente" required maxlength="11" oninput="obtenerRazonSocial(this.value)"><br>

                <label for="razon_social_cliente">Razón Social:</label><br>
                <input type="text" id="razon_social_cliente" name="razon_social_cliente" readonly><br>

                <label for="nombre_cliente">Nombre Cliente:</label>
                <input type="text" id="nombre_cliente" name="nombre_cliente" required><br>

                <!-- Agrega más campos según tus necesidades -->

                <input type="submit" value="Guardar">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
    <!-- Modal para agregar Orden de Compra -->
    <div id="modalOrden" class="modal">
        <div class="modal-content">
            <h5>Agregar Nueva Orden de Compra</h5>
            <form>
                <label for="orden_compra_modal">Orden de Compra:</label>
                <input type="text" id="orden_compra_modal" name="orden_compra_modal" required><br>

                <label for="descripcion_orden">Descripción de la Orden:</label><br>
                <textarea id="descripcion" name="descripcion" class="materialize-textarea" required></textarea>
                <br>
                <!-- Agrega más campos según tus necesidades -->

                <input type="submit" value="Guardar">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Tu script de JavaScript -->
    <script>
        function obtenerRazonSocial(ruc) {
            if (ruc.length === 11) {
                fetch('proxy.php?numero=' + ruc)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nombre) {
                            document.getElementById('razon_social_cliente').value = data.nombre;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar select
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);

            // Inicializar modales
            var modalElems = document.querySelectorAll('.modal');
            var modalInstances = M.Modal.init(modalElems);

            // Cerrar modales al hacer clic en la X
            var closeElems = document.querySelectorAll('.close');
            closeElems.forEach(function(elem) {
                elem.addEventListener('click', function() {
                    var modalInstance = M.Modal.getInstance(elem.closest('.modal'));
                    modalInstance.close();
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar select
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });

        // Funciones para abrir y cerrar modales
        function abrirModalEmpleado() {
            // Código para abrir modal de empleado
        }

        function cerrarModalEmpleado() {
            // Código para cerrar modal de empleado
        }

        function abrirModalCliente() {
            // Código para abrir modal de cliente
        }

        function cerrarModalCliente() {
            // Código para cerrar modal de cliente
        }

        function abrirModalOrden() {
            // Código para abrir modal de orden
        }

        function cerrarModalOrden() {
            // Código para cerrar modal de orden
        }
    </script>
</body>

</html>