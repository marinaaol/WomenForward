<?php
declare(strict_types=1);

// Configuração única da ligação PDO usada por todas as páginas da aplicação.
// Mantém o modelo obrigatório da Stack A: as credenciais ficam neste ficheiro.
$host = 'localhost';
$porta = '3306';
$bd = 'womenforward';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$porta};dbname={$bd};charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $erro) {
    http_response_code(500);
    exit('Não foi possível estabelecer ligação à base de dados.');
}
