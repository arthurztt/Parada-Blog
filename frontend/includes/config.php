<?php
define('API_BASE_URL', 'http://localhost:3000/api');
define('API_NAME', 'Parada Blog');

session_start();

function isLoggedIn(): bool {
    return isset($_SESSION['token']) && !empty($_SESSION['token']);
}

function getCurrentUser(): ?array{
    return $_SESSION['user'] ?? null;
}

function apiRequest(string $endpoint, string $method = 'GET', array $body = [], bool $auth = true): array {
    $url = API_BASE_URL . $endpoint;
    $headers = ['Content-Type: application/json'];

    if ($auth && isLoggedIn()) {
        $headers[] = 'Authorization: Bearer ' . $_SESSION['token'];
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if(!empty($body)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return ['status' => $statusCode, 'data' => json_decode($response, true)];

}
?>