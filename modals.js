document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {});

    var tareasLinks = document.querySelectorAll('.tarea-link');
    tareasLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var descripcion = event.target.getAttribute('data-descripcion');
            document.getElementById('descripcionTarea').innerText = descripcion;
            var modal = M.Modal.getInstance(document.getElementById('tareaModal'));
            modal.open();
        });
    });

    var ordenLinks = document.querySelectorAll('.orden-link');
    ordenLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var descripord = event.target.getAttribute('data-descripord');
            document.getElementById('descripcionOrden').innerText = descripord;
            var modal = M.Modal.getInstance(document.getElementById('ordenModal'));
            modal.open();
        });
    });

    var clienteLinks = document.querySelectorAll('.cliente-link');
    clienteLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var razonSocial = this.getAttribute('data-razon');
            var ruc = this.getAttribute('data-ruc');
            document.getElementById('razonSocialCliente').textContent = razonSocial;
            document.getElementById('rucCliente').textContent = ruc;
            var modal = M.Modal.getInstance(document.getElementById('clienteModal'));
            modal.open();
        });
    });
});
