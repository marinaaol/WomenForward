<?php
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && !validar_token_csrf($_POST['csrf'] ?? null)) {
    http_response_code(400);
    exit('Pedido inválido.');
}