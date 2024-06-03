<?php
header('Content-Type: application/json');

if (isset($_GET['numero'])) {
    $ruc = $_GET['numero'];
    $api_url = "https://api.apis.net.pe/v1/ruc?numero=$ruc";
    $response = file_get_contents($api_url);
    echo $response;
} else {
    echo json_encode(array('error' => 'No se proporcionó el número de RUC.'));
}
?>
