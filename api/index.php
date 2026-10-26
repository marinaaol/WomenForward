<?php
declare(strict_types=1);

// Encaminha apenas páginas PHP existentes no diretório público.
$caminho = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$pagina = $caminho === '/' ? 'index.php' : ltrim((string) $caminho, '/');
if (!preg_match('/^[a-z_]+\.php$/', $pagina) || !is_file(__DIR__ . '/../public/' . $pagina)) {
    http_response_code(404);
    exit('Página não encontrada.');
}
require __DIR__ . '/../public/' . $pagina;
