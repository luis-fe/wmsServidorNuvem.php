<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['usuario']) && isset($_SESSION['empresa'])) {
    $username = $_SESSION['usuario'];
    $empresa = $_SESSION['empresa'];
    $token = $_SESSION['token'];
} else {
    header("Location: ../../../index.php");
}

function ConsultarFila($empresa, $token, $natureza) {
    $baseUrl = ($empresa == "1") ? 'http://192.168.0.183:5000' : 'http://192.168.0.184:5000';
    $apiUrl = "{$baseUrl}/api/DetalhamentoFila?empresa={$empresa}&natureza={$natureza}";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: {$token}",
    ]);

    $apiResponse = curl_exec($ch);

    if (!$apiResponse) {
        error_log("Erro na requisição: " . curl_error($ch), 0);
    }

    curl_close($ch);

    return json_decode($apiResponse, true);
}

function ConsultarCaixa($empresa, $token, $numCaixa) {
    $baseUrl = ($empresa == "1") ? 'http://192.168.0.183:5000' : 'http://192.168.0.184:5000';
    $apiUrl = "{$baseUrl}/api/DetalharCaixa?numeroCaixa={$numCaixa}";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: {$token}",
    ]);

    $apiResponse = curl_exec($ch);

    if (!$apiResponse) {
        error_log("Erro na requisição: " . curl_error($ch), 0);
    }

    curl_close($ch);

    return json_decode($apiResponse, true);
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["acao"])) {
        $acao = $_GET["acao"];

        

        if ($acao == 'Consultar_Fila') {
            $natureza = isset($_GET["natureza"]) ? $_GET["natureza"] : "";
            header('Content-Type: application/json');
            echo json_encode(ConsultarFila($empresa, $token, $natureza));
        } elseif($acao == 'Consultar_Caixa'){
            $numCaixa = isset($_GET["numCaixa"]) ? $_GET["numCaixa"] : "";
            header('Content-Type: application/json');
            echo json_encode(ConsultarCaixa($empresa, $token, $numCaixa));

        }
    }
} else {
    error_log("Método de ação não especificado no método POST", 0);
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'message' => 'Erro: Método de requisição não suportado.']);
}
?>
