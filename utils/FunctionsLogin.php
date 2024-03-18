<?php
// FunctionsLogin.php

function fazerChamadaApi($username, $password) {
    $apiUrl = "http://192.168.0.183:8000/pcp/api/UsuarioSenha?codigo={$username}&senha={$password}";

    // Inicializa a sessão cURL
    $ch = curl_init($apiUrl);

    // Configura as opções da requisição cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: a44pcp22',
    ]);

    // Executa a requisição e obtém a resposta
    $apiResponse = curl_exec($ch);

    // Verifica se houve algum erro na requisição
    if (!$apiResponse) {
        die('Erro na requisição: ' . curl_error($ch));
    }

    // Fecha a sessão cURL
    curl_close($ch);

    // Decodifica a resposta JSON
    $Resposta = json_decode($apiResponse, true);

    return $Resposta;
    
}
