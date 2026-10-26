<?php
declare(strict_types=1);

// Configuração única da ligação PDO usada por todas as páginas da aplicação.
// Mantém o modelo obrigatório da Stack A: as credenciais ficam neste ficheiro.
if (getenv('VERCEL') !== '1') {
    $host = 'localhost';
    $bd = 'womenforward';
    $user = 'root';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} else {
    $host = getenv('DB_HOST');
    $porta = getenv('DB_PORT');
    $bd = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASSWORD');
    $ca = getenv('DB_CA_PEM');

    if (!$host || !$porta || !$bd || !$user || !$pass || !$ca) {
        http_response_code(503);
        exit('Serviço temporariamente indisponível.');
    }

    try {
        $certificado = sys_get_temp_dir() . '/women-forward-ca.pem';
        if (file_put_contents($certificado, $ca, LOCK_EX) === false) {
            throw new RuntimeException('Certificado indisponível.');
        }
        $pdo = new PDO(
            "mysql:host={$host};port={$porta};dbname={$bd};charset=utf8mb4",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_SSL_CA => $certificado,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
            ]
        );
    } catch (Throwable $erro) {
        http_response_code(500);
        exit('Não foi possível estabelecer ligação à base de dados.');
    }
}
