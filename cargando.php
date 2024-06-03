<div class="loading-container" id="loadingContainer">
    <i class="fas fa-spinner fa-spin spinner-icon"></i>
</div>

<style>
    .loading-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .spinner-icon {
        font-size: 50px;
        color: #3498db;
    }
</style>

<script>
    function mostrarCarga() {
        document.getElementById('loadingContainer').style.display = 'flex';
    }
    function ocultarCarga() {
        document.getElementById('loadingContainer').style.display = 'none';
    }
</script>


